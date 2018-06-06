#first section
#.libPaths('C:/R/lib')
#setwd('E:\\R\\engin')

#RMariaDB
#recosystem
#plumber

library(DBI)
library(RMariaDB)
library(recosystem)

con <- dbConnect(MariaDB(), host='localhost', user='root', password='', dbname='movielens')
result <- dbSendQuery(con,paste0('SELECT scr_usr_id,scr_mov_id, ',
                                 'scr_rating FROM scores'))
rated <- dbFetch(result)
print(rated)
dbClearResult(result)
dbDisconnect(con)

#2 train_data -> comlumn for train data
train_data <- data_memory(rated$scr_usr_id, rated$scr_mov_id, rated$scr_rating, index1 = TRUE)
#View(train_data)

#3 tuner #?recosystem::tune //Dimension,niter=iterations
recommender <- Reco()
param <- recommender$tune(train_data, 
                          opts = list(dim = c(20, 30, 40),
                                       niter = 10))


#train_data result is 2 matrix
recommender$train(train_data, opts = c(param$min, 
                                       niter = 10,
                                       verbose = FALSE))

out <- recommender$output(out_memory(), out_memory())


#predict
#apiR





