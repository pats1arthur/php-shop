function ApiRequest(method, path, action, params, onSuccess) {
    const xhr = new XMLHttpRequest();
    const url = `${path}?action=${action}`;
    
    xhr.open(method, url);

    xhr.onerror = function() {
        alert(`Помилка з'єднання`);
    };

    xhr.onload = function() {
        if(xhr.status === 200) {
            onSuccess();
        }
        else {
            alert(`Помилка: ${xhr.status} ${xhr.response}`);
        }
    };

    if(method === "POST") {
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(new URLSearchParams(params).toString());
    } 
    else {
        xhr.send();
    }
    
    return xhr;
}