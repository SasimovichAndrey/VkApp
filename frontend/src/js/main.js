var accessToken = localStorage.getItem('vk_access_token');
var userId = localStorage.getItem('vk_user_id');

if(accessToken != null){
    getUserFriends(getUserFriendSuccess);

    function getUserFriendSuccess(){
        
    }

    function saveUserFriendsToDb(userId, friendIds){
        var reqBody = {
            userId: userId,
            friendIds: friendIds
        };
        var reqBodyJson = JSON.stringify(reqBody);

        var backendRequest = new XMLHttpRequest();
        backendRequest.open('POST', `${BACKEND_API_URL}/addUserFriends`);
        backendRequest.setRequestHeader('Content-Type', 'application/json');
        backendRequest.send(reqBodyJson);
    }
    
    function getUserFriends(callback){
        var callbackFuncName = 'getUserFriendsCallback';
        window[callbackFuncName]= (result) => {
            callback(userId, result.response.items);
        }
        var script = document.createElement('SCRIPT'); 
        script.src = `https://api.vk.com/method/friends.get?&v=${VK_API_VERSION}&callback=${callbackFuncName}&access_token=${accessToken}`; 
        document.getElementsByTagName("head")[0].appendChild(script); 
    }
}
