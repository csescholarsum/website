from flask import Flask

app = Flask(__name__, template_folder="views")

from app.controllers.database import mysql
mysql.init_app(app)

import controllers
