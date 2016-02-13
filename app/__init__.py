from flask import Flask
from flask.ext.mobility import Mobility

app = Flask(__name__, template_folder="views")
Mobility(app)
app.secret_key = 'YELLOW SUBMARINE'

from app.controllers.database import mysql
mysql.init_app(app)

import controllers
