$(".panier").on("click",test)


function test(){
   var id = $('article').attr('id') ;
   var quantity = $('#quantityFragrance').val()
   var name = $('.nameFragrance').val()
  console.log(id)
   $.ajax({
    url:'/add-to-cart',
    type: "POST",
    dataType: "json",
    data: {
        "idParfum": id,
        "quantity": quantity,
        "name" : name
        
    },
    async: true,
    success: function (data)
    {

        console.log(data)
        $( '#nbpanier' ).text('1');
       
}
})       
}