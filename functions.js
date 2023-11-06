function showAlertMsg(type,icon,msg){
    $.toast({
        heading: type,
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: icon,
        hideAfter: 3500,
    });
}