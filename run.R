library(plumber)

api <- plumb('api.R')

api$run(port = 8081)



