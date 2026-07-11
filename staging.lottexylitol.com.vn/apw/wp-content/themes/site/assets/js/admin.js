jQuery(function($){

    if( typeof $.fn.sortable == 'undefined' ) return console.log('jQuery UI sortable not found');

    $('.site_survey_questions').each(function(){
        let p = $(this), 
            ul = $('ul', p), 
            html = $('li:first', ul).prop('outerHTML');

        p.on('click', '.js-add-row', function(e){
            e.preventDefault();
            
            let li = $(html);

            li.find('[data-field]').val('');

            ul.append(li);

            update_index(ul);
        }).on('click', '.js-remove-row', function(e){
            e.preventDefault();

            $(this).closest('li').remove();

            update_index(ul);
        });

        ul.sortable({
            update: function(event, ui){
    
                update_index(ul);
            }
        });

        update_index(ul);
    });

    function update_index(ul)
    {
        ul.find('li').each(function(index){
            $(this).find('[data-field]').each(function(){
                let input = $(this);

                input.attr('name', input.data('field') + '['+ index +']');
            });
        });
    }

    // change checkbox to radio
    $(window).on('load', function(){
        $('[name="tax_input[winner_cat][]"][type="checkbox"]').attr('type', 'radio');
    });

});