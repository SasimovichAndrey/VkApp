var accessToken = localStorage.getItem('vk_access_token');
var userId = localStorage.getItem('vk_user_id');

function getUserFriendsSuccess(friends){
    vue.isFetchingFriends = false;
    vue.friends = friends;
}

function getSelectedFriendsSuccess(friends){
    vue.isFetchingSelectedFriends = false;
    vue.selectedFriends = friends;
}

function getSelectedFriends(callback){
    var backendRequest = new XMLHttpRequest();
    backendRequest.open('GET', `${BACKEND_API_URL}/getSelectedFriends/${userId}`);
    backendRequest.onreadystatechange = () => {
        if(backendRequest.readyState == 4){
            var data = JSON.parse(backendRequest.responseText);
            callback(data);
        }
    };

    backendRequest.send();
}

function saveUserFriendsToDb(userId, friendIds){
    var reqBody = {
        userId: userId,
        selectedUsers: friendIds
    };
    var reqBodyJson = JSON.stringify(reqBody);

    var backendRequest = new XMLHttpRequest();
    backendRequest.open('POST', `${BACKEND_API_URL}/saveUserSelectedFriends`);
    backendRequest.setRequestHeader('Content-Type', 'application/json');
    backendRequest.send(reqBodyJson);
}

function getUserFriends(callback){
    var callbackFuncName = 'getUserFriendsCallback';
    window[callbackFuncName]= (result) => {
        callback(result.response.items);
    }
    var script = document.createElement('SCRIPT'); 
    var fieldsList = 'first_name,last_name,id'
    script.src = `https://api.vk.com/method/friends.get?&v=${VK_API_VERSION}&callback=${callbackFuncName}&access_token=${accessToken}&fields=${fieldsList}`; 
    document.getElementsByTagName("head")[0].appendChild(script); 

    vue.isFetchingFriends = true;
}

var vue = new Vue({
    el: "#app",
    data: {
        isAuthorized: accessToken != null,
        isFetchingFriends: null,
        friends: null,
        selectedFriends: null,
        isFetchingSelectedFriends: true
    },
    methods: {
        isSelectedByUser(id){
            return this.selectedFriends.find((el) => el == id) != null ? 'checked': '';
        },
        saveSelectedUsers(){
            saveUserFriendsToDb(userId, this.selectedFriends);
        }
    }
});

if(accessToken != null){
    getUserFriends(getUserFriendsSuccess);
    getSelectedFriends(getSelectedFriendsSuccess);
}
