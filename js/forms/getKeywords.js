import { submissionsEndpoint } from "../constants.js";


async function GetKeywords(articleID) {
    return fetch(`https://test.asfirj.org/backend/accounts/getKeywords.php`,{
        method:"POST",
        body: JSON.stringify({article_id:articleID})

    }).then(res=>res.json())
    .then(data=>{
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