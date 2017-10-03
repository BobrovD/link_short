/**
 * Created by Orange on 03.10.17.
 */


let validate = (type, val) => {
    switch(type){
        case 'url':
            re = /((?:http|https):\/\/)?((?:[\w-]+)(?:\.[\w-]+)+)(?:[\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
        break;
        case 'code':
            re = /^[a-zA-Z0-9]{5,}$/;
        break;
        default:
            return false;
    }
    return re.test(val);
};

let on_change_input = (input) => {
    if($(input).attr('data-active') === 'false')
        return false;
    let code = $(input).val();
    if(code === $(input).attr('data-baseval')){ //проверяем, если это изначально присланное значение
        link_button.src = '/img/apply.png';
        $(link_button).attr('data-action', 'imitate_save');
        return false;
    }
    if(!validate('code', code)){
        console.log(link_button.src);
        link_button.src = '/img/unavailable.png';
        $(link_button).attr('data-action', '');
        return false;
    }
    link_button.src = '/img/apply.png';
    $(link_button).attr('data-action', 'save');
    $.get('/api.php?a=available_code', {code: code}, (data)=>{
        if(data === 'OK'){
            link_button.src = '/img/apply.png';
        }else{
            link_button.src = '/img/unavailable.png';
        }
    })
};