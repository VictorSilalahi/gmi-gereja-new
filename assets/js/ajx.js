
export function ajax_post(url, data_to_send) {

    let temp;
    $.ajax({
        url: url,
        data: data_to_send,
        method: "POST",
        dataType: "json",
        async: false,
        beforeSend:function() {
            
        },
        success: function(data) {
            temp = data;
        }
    });

    return temp;

}

export function ajax_get(url, data_to_send) {

    let temp;
    $.ajax({
        url: url,
        data: data_to_send,
        method: "GET",
        dataType: "json",
        async: false,
        beforeSend:function() {
        },
        success: function(data) {
            temp = data;
        }
    });

    return temp;

}

export function ajax_put(url, data_to_send) {

    let temp;
    $.ajax({
        url: url,
        data: data_to_send,
        method: "PUT",
        dataType: "json",
        async: false,
        beforeSend:function() {
        },
        success: function(data) {
            temp = data;
        }
    });

    return temp;

}

export function ajax_delete(url, data_to_send) {

    let temp;
    $.ajax({
        url: url,
        data: data_to_send,
        method: "DELETE",
        dataType: "json",
        async: false,
        beforeSend:function() {
        },
        success: function(data) {
            temp = data;
        }
    });

    return temp;

}

export async function fetch_post(url, data) 
{
    const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });
    
    let ret = await response.json(); // Returns a promise
    return ret;

}

export async function fetch_get(url, data) 
{
    const response = await fetch(url, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });
    
    let ret = response.json(); // Returns a promise
    return ret;
}

export async function fetch_post2(url, data) 
{
    let data_temp = data;
    try {
        const response = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data_temp)
            }
        );            

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const data = await response.json();
        // console.log(data);
        return data;
    } catch (error) {

        console.error(`Could not get products: ${error}`);
        throw error;

    }    

}