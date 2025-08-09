import { submissionsEndpoint } from "../constants.js"

async  function GetAttachments(emailID){
    return fetch(`https://greek.asfirj.org/backend/email/getAttachments.php?e=${emailID}`)
    .then(res =>res.json())
    .then(data =>{
        if(data.status === "success"){
            return data.attachments
        }else{
            return []
        }
    })
}
export {
    GetAttachments
}