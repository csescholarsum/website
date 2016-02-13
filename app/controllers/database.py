from app import app
from flask.ext.mysqldb import MySQL

# MySQL
mysql = MySQL()
app.config["MYSQL_USER"] = ""
app.config["MYSQL_PASSWORD"] = ""
