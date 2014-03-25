
function delete_user(id) {
    if(window.confirm("你确定要删除该用户？?")){
//        alert(id);
//        $('#'+id).fadeOut("slow");
        $.post("delete",
        {
            id:id
        },
        function(data){
            
            if(1===$.parseJSON(data).status) $('#'+id).fadeOut("slow");
            
        });
        $('#'+id).fadeOut("slow");
    }
}
function delete_docfile(id) {
    if(window.confirm("你确定要删除该文件？")){
//        alert(id);
//        $('#'+id).fadeOut("slow");
        $.post("delete",
        {
            id:id
        },
        function(data){
            
            if(1===$.parseJSON(data).status) $('#'+id).fadeOut("slow");
            
        });
        $('#'+id).fadeOut("slow");
    }
}
