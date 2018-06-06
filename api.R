#* @filter cors
function(res){
  res$setHeader("Access-control-Allow-Origin","*")
  plumber::forward()
}
#* @get /recommend
function(user_id){
  conn <- dbConnect(MariaDB(), host='localhost', user='root', password='', dbname='movielens')
  sql <- paste0('SELECT ', user_id, ' as usr_id, ', 
                'mov_id FROM movies WHERE CONCAT( ',
                user_id, ',",",mov_id ) NOT IN (',
                'select concat(scr_usr_id,",",scr_mov_id) ',
                'from scores where scr_usr_id= ',
                user_id, ')')
  sql
  rs <- dbSendQuery(conn,sql)
  
  
  unrated <- dbFetch(rs)
  dbClearResult(rs)
  dbDisconnect(conn)
  need_data <- data_memory(unrated$usr_id,
                           unrated$mov_id,
                           index1 = TRUE)
  
  predict <- recommender$predict(need_data, out_memory())
  #หาค่าtop10
  top_scores <- sort(predict, decreasing = TRUE)[1:10]
  #View(top_scores)
  #ผลลัพย์ของการ จับคู่ได้อินเด็กออกมา
  index <- match(top_scores, predict)
  #slot แยก obj S4 ออกมา จับยัดidหนังกับ คะแนนที่ทำนาย
  list(slot(need_data, 'source')[2][[1]][index],
       top_scores)
}