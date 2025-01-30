import { submissionsEndpoint } from "../constants.js";


async function GetKeywords(articleID) {
    return fetch(`${submissionsEndpoint}/backend/accounts/getKeywords.php`,{
        method:"POST",
        body: JSON.stringify({article_id:articleID})

    }).then(res=>res.json())
    .then(data=>{
        console.log(data.keywords)
        if(data){
        if(data.success){
            return data.keywords
        }else{
            return []
        }
    }else{
        console.warn("No data received.")
        return []
    }
    })
}

export {
    GetKeywords
}