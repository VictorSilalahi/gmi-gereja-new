
export function ajax_post(url, data_to_send) 
{

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

export function ajax_get(url, data_to_send) 
{

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

export function ajax_put(url, data_to_send) 
{

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

export function ajax_delete(url, data_to_send) 
{

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

export function check_token() 
{

    const token = localStorage.getItem('4pp_t0k3n');

    const base_url = $("#base_url").val();

    if (!token) {
        // No token found, redirect to login page
        window.location.href = base_url; 
        return false;
    }

    // Periksa token melalui ajax
    $.ajax({
        url: base_url+'api/intern/periksa_token', // Replace with your backend verification endpoint
        type: 'POST',
        async: false,
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function(response) {
            // console.log('Token is valid, user is authenticated.');
            // // Proceed with loading page content or showing the dashboard
            // console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Token verification failed:', error);
            // Clear the token and redirect to login
            localStorage.removeItem('4pp_t0k3n');
            window.location.href = base_url;
        }
    });
    
}