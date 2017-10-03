/**
 * Created by Orange on 03.10.17.
 */

let base_url = 'http://178.62.73.173/';

let urlc = {
    url: '',
    code: '',
    id: 0
};

$(document).ready(()=>{

    $('#get_code').click(function(){
        let url_p = $('#url');
        let url = url_p.val();
        if(!validate('url', url)) {
            url_p.val('');
            return false;
        }

        $.get('/api.php?a=new_link', {url: url}, (data)=>{
            url_p.val('');
            result = JSON.parse(data);
            urlc.url = url;
            urlc.code = result.code;
            urlc.id = result.id;
            let link_container = $('#link_container');
            let link = $('#link');
            let link_code = $('#link_code');
            let link_button = $('#link_button');
            $(link_button).attr('data-action', 'edit');
            link.html(base_url + urlc.code);
            link_code.val(urlc.code);
            $(link_code).attr('data-baseval', urlc.code);
            link_container.fadeIn(200);
        })
    });

    $('#link_button').click(function(){
        let action = $(this).attr('data-action');
        let link = $('#link');
        let label = $('#label');
        let link_code = $('#link_code');
        switch(action){
            case 'edit':
                $(this).attr('data-action', 'imitate_save');
                link.css('display', 'none');
                label.css('display', 'block');
                link_code.attr('data-active', 'true');
                link_code.css('display', 'block');
                this.src = '/img/apply.png';
                break;

            case 'imitate_save' :
                $(this).attr('data-action', 'edit');
                link.html(base_url + urlc.code);
                link.css('display', 'block');
                label.css('display', 'none');
                link_code.css('display', 'none');
                link_code.attr('data-active', 'false');
                this.src = '/img/edit.png';
                break;

            case 'save' :
                urlc.code = link_code.val();
                let ths = this;
                $.get('/api.php?a=update_code', {id: urlc.id, code: urlc.code}, function(data){
                    $(this).attr('data-action', 'edit');
                    link.html(base_url + urlc.code);
                    link.css('display', 'block');
                    label.css('display', 'none');
                    link_code.css('display', 'none');
                    link_code.attr('data-active', 'false');
                    ths.src = '/img/edit.png';
                })
        }
    });



});

