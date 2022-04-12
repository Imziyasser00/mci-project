check['country'] = function() {
										var to = document.getElementById('to'),
										var from = document.getElementById('from'),								
if (to.value != 'none')
{
tooltipStyle.display = 'none';
return true;
} else {
tooltipStyle.display = 'inline-block';
return false;
}
};
