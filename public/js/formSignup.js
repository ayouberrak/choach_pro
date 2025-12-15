document.addEventListener("DOMContentLoaded", () => {
    let selectRole = document.getElementById("roleSelect");
    let divCoach = document.getElementById("divCoach");
    let divClient = document.getElementById("divClient");
    
    selectRole.addEventListener('change', e => {
        if(selectRole.value === "2"){
            divCoach.style.display = "block";
            divClient.style.display ="none";
        } else {
            divCoach.style.display = "none";
            divClient.style.display ="block";
        }
    });
});
