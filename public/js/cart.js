$(document).ready(function(){

    //plus button click
    $('.btn-plus').click(function(){
        $parentNode=$(this).parents('tr');
        $price=Number($parentNode.find('#price').text().replace('kyats',''));

        $quantity=$parentNode.find('#qty').val();
        $total=$price*$quantity;
        $parentNode.find('#total').html($total+" kyats");
        summaryCalculate();

    })
    //minus button click
    $('.btn-minus').click(function(){
        $parentNode=$(this).parents('tr');
        $price=Number($parentNode.find('#price').text().replace('kyats',''));;
        $quantity=$parentNode.find('#qty').val();
        $total=$price*$quantity;
        $parentNode.find('#total').html($total+" kyats");
        summaryCalculate();
    })

    //calculate final price
   function summaryCalculate(){
    $totalprice=0;
        $('#dataTable tbody tr').each(function(index,row){
          $totalprice+=Number($(row).find('#total').text().replace('kyats',''));
        });
        $('#subTotal').html($totalprice+" kyats");
        $('#finalPrice').html(`${$totalprice+3000} kyats`);
   }
})
