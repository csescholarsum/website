from flask import render_template
from app import app

@app.route('/members')

def members():
	return render_template("index.html", page='mem')
