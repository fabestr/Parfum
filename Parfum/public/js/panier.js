$(".panier").on("click",test)


function test(){
   var id = $('article').attr('id') ;
  console.log(id)
   $.ajax({
    url:'/order',
    type: "POST",
    dataType: "json",
    data: {
        "idParfum": id
        
    },
    async: true,
    success: function (data)
    {

        console.log(data)
        $( '#nbpanier' ).text('1');
       
}
})       
}