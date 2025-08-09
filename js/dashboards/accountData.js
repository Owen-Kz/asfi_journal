import { submissionsEndpoint } from "../constants.js";
import { GetCookie } from "../setCookie.js";


function GetAccountData(useremail){
    
    const formData = {
        encrypted:useremail
    }
  return  fetch(`https://greek.asfirj.org/backend/accounts/accountData.php`, {
        method:"POST",
        body:JSON.stringify(formData),
        headers:{
            "Content-type" : "application/JSON"
        }
    }).then(res=>res.json())
    .then(data=>{
        if(data.status === "success"){
            const accountData = data.accountData
            
            return accountData
    }else{
        console.log(data.message)
        return null
    }
    })

}

export {
    GetAccountData
}