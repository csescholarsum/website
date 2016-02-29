from flask import render_template
from app import app

@app.route('/tutoring')

def tutoring():
	return render_template("index.html", page='tut')
