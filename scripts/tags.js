let tagInputBox = document.getElementById("tag-input");
let addTagButton = document.getElementById("addTagButton");
let tagsDiv = document.getElementById("tagsDiv");
let currentTags = [];

window.onload = getTags;

function addTagToFilter() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        currentTags.push(tag);

        console.log("Adding " + tag + " to filter");
        console.log("Filters are now: " + currentTags);

        let newTag = document.createElement("p");
        let newTagNode = document.createTextNode(tag);
        newTag.appendChild(newTagNode);
        newTag.setAttribute("class", "tags");
        newTag.setAttribute("id", tag);
        newTag.setAttribute("onclick", "removeTag('" + tag + "')");
        tagsDiv.appendChild(newTag);

        tagInputBox.value = "";
        addTagButton.setAttribute("hidden", "true");

        let url = "/processjob.php?tags=[" + currentTags + "]";
        document.getElementById("main-form").setAttribute("action", url);

    }

}

function showAddTagButton() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        addTagButton.removeAttribute("hidden");

    } else {

        addTagButton.setAttribute("hidden", "true");

    }

}

function getTags() {

    let httpRequest = new XMLHttpRequest();
    let url = "downloadTags.php";

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = function () {

        if (httpRequest.readyState === XMLHttpRequest.DONE) {

            if (httpRequest.status === 200) {

                let request = httpRequest.response;
                tagsArray = request.split("<br/>");
                console.log(tagsArray);
                autocomplete(tagInputBox, tagsArray);

            }

        }

    };

    httpRequest.open("GET", url);
    httpRequest.send();

}