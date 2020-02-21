function renewTags(){
    $.ajax({
        url: '/news/tags/getauthors',
        type: 'get',
        dataType: 'html',
        async: false,
        crossDomain: 'true',
        success: function(data, status) {
            $("#news-tags option").remove();
            $("#news-tags").append(data);
        },
        error: function(data, status){
            alert('Возникла ошибка');
        }
    });
    
}
function addTags(){
    if(string = prompt("Введите тег:")){
        $.ajax({
            url: '/news/tags/createtags',
            data: {
                name: string
            },
            type: 'get',
            dataType: 'html',
            async: false,
            crossDomain: 'true',
            success: function(data, status) {
                renewTags();
                alert('Тег добавлен');
            },
            error: function(data, status){
                alert('Возникла ошибка');
            }
        });
    }
}
