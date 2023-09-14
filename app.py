from flask import Flask,redirect,url_for,render_template, request
from readExcel import readExcel
from resultToJson import resultToJson
from jsonToCRM import jsonToCRM
import os

app = Flask(__name__)


@app.route('/')
def hello():
    return render_template("index.html")

@app.route('/readFile',methods=["GET",'POST'])
def readFile():
    if 'file' not in request.files:
        return "No file part"
    
    file = request.files['file']
    
    if file.filename == '':
        return "No selected file"
    
    # You can specify the directory where you want to save the uploaded file
    upload_dir = 'uploads'
    if not os.path.exists(upload_dir):
        os.makedirs(upload_dir)
    
    # Save the file to the specified directory
    file_path = os.path.join(upload_dir, file.filename)
    file.save(file_path)
    
    # Get the values of the additional input fields
    employee_id = request.form.get('employeeID')
    opportunity_id = request.form.get('opportunityID')
    price_id = request.form.get('priceID')
    
    # Call your Python function to process the file and additional data
    excelData = readExcel(file_path)
    json = resultToJson(excelData,employee_id,opportunity_id,price_id)
    # CRM = jsonToCRM(json)
    # You can then do something with the result, like returning it as a response
    return json
if __name__ == '__main__':
    app.run()