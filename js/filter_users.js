$(document).ready(function(){
    var user = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('username', 'dni'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
	identify: function(obj) {
	    return obj.id;
	},
        local: users
    });

    $('.search-typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'user',
        source: user,
	display: 'username',
	limit: 5
    }).on('typeahead:selected', function(e, suggestion){
	$( '.typeahead').val(suggestion.id);
	e.target.form.submit();
   });
});
