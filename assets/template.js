function templateTopic(param){
let str ="";
for (let i = 0; i < param.length; i++) {
    str = '<tr>';
    str += '<td>'+iconeEdit+'</td><td>'+Topic+'</td><td>'+pseudo+'</td>';
    str += '</tr>';
    }
    return str;
}