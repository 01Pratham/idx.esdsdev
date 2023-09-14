import json
import datetime
from db import cursor as conn
from readExcel import readExcel

def resultToJson(result,empID,opptID,priceList):
    DateTime = datetime.datetime.now()
    Date = DateTime.date()
    formatted_date = Date.strftime('%Y-%m-%d')
    
    query = "SELECT * FROM `login_master` WHERE `employee_code` = '"+empID+"'"
    conn.execute(query)
    userQueryResp = conn.fetchall()
    try: 
        userID = userQueryResp[-1]['crm_user_id']
        # print (userID)
    except IndexError as e :
        return "Employee not found"


    template = {
        "opportunity_id": opptID,
        "quotation_id": "",
        "price_list": priceList,
        "user_id": userID,
        "phase_name": []
    }

    for i in result:
        for Phase in i:
            if Phase == "Phase":
                template["phase_name"].append(
                    {
                        "phase" : i[Phase] ,
                        "phase_start_date": formatted_date,
                        "phase_tenure_month": 1,
                        "phase_total_recurring": 1,
                        "phase_total_otp": 1, 
                        "group_name" : []
                    })
            if Phase == "Groups":
                for arr in i[Phase]:
                    for Group in arr:
                        if Group == "Group":
                            template['phase_name'][-1]['group_name'].append(
                                {
                                    "quotation_group_name": arr[Group], 
                                    "group_otp_price": 1,
                                    "group_recurring_price": 1,
                                    "group_quantity": arr["GroupQty"],
                                    "products": []
                                })
                        if Group == "Items":
                            for itemArr in arr[Group]:
                                template['phase_name'][-1]['group_name'][-1]["products"].append({"product_sku": itemArr['SKU_Code'],"product_quantity": itemArr['Quantity']})

    json_data = json.dumps(template , indent=4)

    return json_data
    # print(json_data)
# data = readExcel("Trail.xlsx")
# resultToJson(data,"3094","01865" , "1")
