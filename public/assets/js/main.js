function showAdditionalFields() {
    var selectedType = document.getElementById("productType").value;
    var sizeField = document.getElementById("sizeField");
    var weightField = document.getElementById("weightField");
    var dimensionsField = document.getElementById("dimensionsField");

    sizeField.style.display = "none";
    weightField.style.display = "none";
    dimensionsField.style.display = "none";

    if (selectedType === "DVD") {
        sizeField.style.display = "block";
    } else if (selectedType === "Book") {
        weightField.style.display = "block";
    } else if (selectedType === "Furniture") {
        dimensionsField.style.display = "block";
    }
}