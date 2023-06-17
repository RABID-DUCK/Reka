function createList(){
    if (document.getElementById('recipient-name').value === "") return alert("Заполните поле названия!")
    let form = document.getElementById('create-form');

    let formatData = new FormData(form);

    fetch('/api/createList', {
        method: "post",
        body: formatData
    })
        .then(response => response.json())
        .then(data => {
            let lists = document.getElementById('listTodo');
            lists.innerHTML = "";

            data.forEach(list => {
                console.log(list);
                lists.insertAdjacentHTML('beforeend', "<div class=\"p-6 border border-bottom-secondary\">\n" +
                "<div class=\"flex items-center\">\n" +
                "<img src='"+ list.image +"'" +
                    "alt="+list.title+" width=\"150px\" height=\"150px\">" +
                "<div class=\"ml-4 text-lg leading-7 font-semibold\">" +
                    "<a href=\"https://laravel.com/docs\" class=\"underline text-gray-900 dark:text-white\">" +
                    list.title+"</a></div>\n" +
                "</div>\n" +
                "\n" +
                "<div class=\"ml-12\">\n" +
                "<b>Теги: </b>\n" +
                "<div class=\"mt-2 text-gray-600 dark:text-gray-400 text-sm\">\n" +
                list.tags +
                "</div>\n" +
                "</div>\n" +
                "</div>")
            })
        })
}
