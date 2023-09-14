import requests

def jsonToCRM(json_data):

  url = "https://swayatta.esds.co.in:31199/mobile_crm/opportunity/create_quotation.php"
  # url = "http://115.124.127.130/~crmesdsdev/mobile_crm/opportunity/create_quotation.php"

  payload = json_data
  headers =   {
    'Content-Type': 'text/plain'
  }

  response = requests.request("POST", url, headers=headers, data=payload)

  return(response.text)
