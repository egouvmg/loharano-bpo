$(function () {
	$('input[type=radio][name=site_lang]').change(function() {
        var lang = this.value;

        $.post('changer_langue', {lang:lang}, function(res){
            if(res.success == 1) location.reload();
            else alert('Immposible de changer la langue');
        }, 'JSON');
    });
});