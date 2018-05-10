# Assignment for Full Stack Developer Intern Selection - eLocals
Task Overview:
    You will be required to create a signin cum referral webpage for eLocals extension.
    
Assumptions:
    It is assumed that user would have created an account using mobile app. So, there is no
    scope of signup. Only signin.

Language:

    Backend : PHP 
    Frontend : HTML, CSS, Javascript, jQuery and AJAX.

Database Design:

    1. User table - containing the following information
        Columns:
            1. Sno - serial number of the row
            2. mobile
            3. password
            4. myrefer - own refer id to be shared among other users.
            5. deviceserial - mobile specific fields
            6. devicemac - mobile specific fields
            7. devicemodel - mobile specific fields
            8. deviceid - mobile specific fields
            9. cashbackstatus - "DONE" or "null"
            
    2. Cashback table
       Columns:
            1. mobile
            2. amount
    
    3. refercount
       Columns:
            1. mobile - mobile number of the user who registered now.
            2. referralcode - the referral code used while signing in.
            3. amount - amount credited.
            4. referralmobile - mobile number of the user whose referral code was used.
            5. description - "Referral bonus" - this is a constant.
            6. timestamp

    4. passbook
       Columns:
            1. mobile
            2. title - [Signup Bonus or Referral Bonus] depending on context.
            3. description - [Signup cash received or eReferral cash received] depending on context.
            4. amount
            5. timestamp

In the front end, there will be 2 text fields and a button.
1. MobileNumber text field.
2. Referral Code text field.
3. Get cashback button.

Code Flow:
We will break it into 2 cases:

Case 1: When referral code is not entered by the user.
        
    Steps:
    1. Check if the mobile number is present in the login table.
        If no:
            Display a message saying you need to sinup in elocals app first.
        If yes:
            Check if the cashbackstatus is "Done" for that user.
            If yes:
                Show a message stating that the cashback has already been given.
                Show the referral code for that mobile so that it can be shared.
            If no:
                Show a message stating that the cashback earned.
                Show the referral code for that mobile so that it can be shared.

                login table updation:
                    Get the (devicemac, devicemac, devicemodel, deviceid) for that mobile.
                    Update cashbackstatus to "Done" for that (devicemac, devicemac, devicemodel, deviceid).
                
                passbook table updation:
                    update the passbook table with title as "Signup bonus" and description "Signup cash received"
                    and amount 100 for that mobile.
                
                cashback table updation:
                    if the entry for that mobile no exits then add 100 to the amount.
                    else create a new entry in the table for that mobile and amount = 100.
                           

Case 2: When referral code is entered by the user.

    Steps:
        1. Check if the mobile number is present in the login table.
        If no:
            Display a message saying you need to signup in elocals app first.
        If yes:
            Check if the cashbackstatus is "Done" for that user.
            If yes:
                Show a message stating that the cashback has already been given.
                Show the referral code for that mobile so that it can be shared.
            If no:
                Show a message stating that the cashback earned.
                Show the referral code for that mobile so that it can be shared.
                
                //same updations as in Case 1:
                login table updation:
                    Get the (devicemac, devicemac, devicemodel, deviceid) for that mobile.
                    Update cashbackstatus to "Done" for that (devicemac, devicemac, devicemodel, deviceid).

                passbook table updation:
                    update the passbook table with title as "Signup bonus" and description "Signup cash received"
                    and amount 100 for that mobile.

                
                cashback table updation:
                    if the entry for that mobile no exits then add 100 to the amount.
                    else create a new entry in the table for that mobile and amount = 100.


                //New updations
                Get number of records in refercount table where referralcode = (refercode entered by user).
                If count == 10:
                    do nothing
                Else:
                    from login table get the mobile number whose myrefer = referralcode entered by user
                    passbook table updation:
                        update the passbook table with title as "Referral bonus" and description "eReferral cash received"
                        and amount 50 for the mobile of the user who referred.

                    cashback table updation:
                        if the entry for that mobile no exits then add 50 to the amount.
                        else create a new entry in the table for the mobile of the user who referred and amount = 50.        

                    refercount table updation:
                        insert a new record with:
                            mobile = mobile no of the user who registered
                            referralcode = referralcode entered by the user
                            amount = 50
                            referrermobile = mobile of the user who referred
                            description = "Referral bonus"
                            timestamp
                            
 Implementation:
 
 Case 1 will always execute unless the mobile number is not entered, and if both mobile  and referral are given, then only the extra coditions of Case 2 will be executed as Case 2 also contains the conditions of Case 1.
 
 The referral code generated can be shared through various social media platforms like Twitter,Linkedin and Facebook.
 
