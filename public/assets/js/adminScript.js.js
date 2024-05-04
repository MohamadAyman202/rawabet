// Function to handle state change
console.log(stateId);
console.log(cityId);
function stateChangeHandler(country_id, state_id) {
    const city = $("select[name='city_id']");
    $.ajax({
        type: "GET",
        url: `${window.location.origin}/api/city_data/${country_id}/${state_id}`,
        success: function (response) {
            // Populate the cities dropdown
            city.empty(); // Clear existing options
            $.each(response.data, function (i, ele) {
                city.append(`
                    <option ${
                        stateId != null && stateId == ele.id ? "selected" : ""
                    } value="${ele.id}">${ele.name}</option>
                `);
            });
        },
    });
}

// Function to retrieve states based on country ID
function getStatesByCountry(country_id) {
    $.ajax({
        type: "GET",
        url: `${window.location.origin}/api/state_data/${country_id}`,
        success: function (response) {
            // Populate the states dropdown
            const state = $("select[name='state_id']");
            state.empty(); // Clear existing options
            $.each(response.data, function (i, ele) {
                state.append(`
                    <option ${
                        cityId != null && cityId == ele.id ? "selected" : ""
                    } value="${ele.id}">${ele.name}</option>
                `);
            });
            // Get the initial state ID
            const state_id = state.val();
            // Call stateChangeHandler with the initial state ID
            stateChangeHandler(country_id, state_id);
        },
    });
}

// Attach change event listener to country dropdown
$("select[name='country_id']").on("change", function () {
    const country_id = $(this).val();
    getStatesByCountry(country_id);
});

// Attach change event listener to state dropdown
$("select[name='state_id']").on("change", function () {
    const country_id = $("select[name='country_id']").val();
    const state_id = $(this).val();
    stateChangeHandler(country_id, state_id);
});

$(document).ready(function () {
    // Call getStatesByCountry function when the page loads
    getStatesByCountry($("#country_id").val());
});
