from flask import render_template
from app import app

@app.route('/projects')

def projects():
	return render_template("index.html", page='proj')
