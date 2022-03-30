// evement au survole de la sourie
$('.zone1').on('mouseover', function() {
    $('.zone1').css('color', '#e46e3c');
});

$('.zone2').on('mouseover', function() {
    $('.zone2').css('color', '#4ca99d');
});
// evement inverse 
$('.zone1').on('mouseout', function() {
    $('.zone1').css('color', 'black');
});

$('.zone2').on('mouseout', function() {
    $('.zone2').css('color', 'black');
});

//Newsletter 
$('.zone3').on('blur', function(){
    $('.zone3').css('background-color', '#ffc107')
})