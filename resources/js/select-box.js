document.querySelectorAll(".selectBox").forEach((sl) => {
  sl.classList.add('_select-box');
  const lsData = JSON.parse(sl.getAttribute('data-selectBox-list'));
  const aNama = sl.getAttribute('data-selectBox-nama');
  const dataValue = sl.getAttribute('data-value');
  let dataLabel = 'Pilih Data';
  //const selectBox= document.createElement("div");
  //selectBox.classList.add('_select-box');
  
  const options_container = document.createElement("div");
  options_container.classList.add('_options-container');
  options_container.id="opc_"+aNama

  sl.appendChild(options_container)

  for (var i = lsData.length - 1; i >= 0; i--) {
    const options = document.createElement("div");
    options.classList.add('_option');
    options.id="op"+i+"_"+aNama

    const radio = document.createElement("input");
    radio.setAttribute("type", "radio");
    radio.classList.add('_radio');
    radio.id = lsData[i].id;
    radio.name = aNama;
    radio.value = lsData[i].id;

    options.appendChild(radio);

    const radioLabel = document.createElement("label");
    radioLabel.setAttribute("for", lsData[i].id);
    radioLabel.setAttribute("data-target", "sel_"+aNama);
    radioLabel.innerText = lsData[i].nama;

    options.appendChild(radioLabel);

    options_container.appendChild(options)

    //console.log(lsData[i].id , dataValue)
    if(dataValue == lsData[i].id){
      dataLabel = lsData[i].nama
    }
  }

  const _selected = document.createElement('div')
  _selected.classList.add('_selected')
  _selected.id = 'sel_'+aNama
  

  sl.appendChild(_selected);

  const _searchBox = document.createElement('div')
  _searchBox.classList.add('_search-box')

  const _searchBoxInput = document.createElement('input')
  //_searchBox.classList.add('_search-box')
  _searchBoxInput.placeholder = 'Cari...'

  _searchBox.appendChild(_searchBoxInput);
  sl.appendChild(_searchBox);

  _selected.innerText = dataLabel
});

//----------------------------------------------------------------------//

const selecteds = document.querySelectorAll("._selected");
const optionsContainers = document.querySelectorAll("._options-container");
const activeOptionsContainers = document.querySelectorAll("._options-container ._option");
const searchBoxs = document.querySelectorAll("._search-box input");
let selected_options = [];

/*activeOptionsContainers.forEach((aoc) => {
  aoc.addEventListener('click', function(){
    var selText = aoc.lastChild.innerText
    
    var parentOfThis = aoc.parentElement
    parentOfThis.classList.remove("_active")
    var nextSibling = parentOfThis.nextSibling
    //console.log()
    nextSibling.innerHTML = selText
  })
})*/

selecteds.forEach((sl) => {
  sl.addEventListener('click', function(e) {
    //const target = e.target;
    //console.log(e.target)
    const curSelect = e.target;
    const curOptionsContainer = curSelect.previousSibling;
    const curSearchBox = curSelect.nextSibling;

    optionsContainers.forEach((el) => {
      el.classList.remove('_active')
    })
    
    curSearchBox.value = ""
    //filterList("");

    curOptionsContainer.classList.toggle("_active")

    const childNodes = curOptionsContainer.childNodes
    //console.log(childNodes)

    childNodes.forEach(el => {
      el.addEventListener('click', (e) => {
        const { parentNode, tagName, lastChild } = e.target;
        var selText = ''

        if (tagName === 'INPUT' || tagName === 'LABEL' ) {
          // ...and log the key value of the parent dataset
          //console.log(tagName, parentNode.lastChild.innerHTML);
          selText = parentNode.lastChild.innerHTML
        }
        // Otherwise, if it's the div element
        if (tagName === 'DIV') {
          // ...log the key value from its dataset
          //console.log(tagName, lastChild.innerHTML);
          selText = lastChild.innerHTML;
        }

        //console.log(selText)
        //curSelect.innerHTML = selText;
        console.log(curSelect.id)


        /*var selText = e.target.querySelector("label").textContent
        var selTarget = el.querySelector("label").getAttribute('data-target')
        //console.log(selText)
        var parentOfThis = el.parentElement.nextElementSibling
        //console.log(parentOfThis.id)
        if(parentOfThis.id == selTarget){
          parentOfThis.innerHTML = selText  
        }*/
        
        //console.log(selText)
        //console.log(el.querySelector("label").innerHTML)
        //target.innerHTML = el.querySelector("label").innerHTML
        curOptionsContainer.classList.remove("_active")
      })
    })

    /*searchBoxs.forEach((el) => {
      el.value = ""
    })*/

    //const nodeList = e.currentTarget.parentElement.children;
    //console.log(nodeList)
    //nodeList[0].classList.toggle("_active")
    //const childNodes = nodeList[0].childNodes
    //selected_options = childNodes

    /*selected_options.forEach(o => {
      o.addEventListener("click", (e) => {
        
        nodeList[0].classList.remove("_active");
        console.log(nodeList[1].innerText)
        nodeList[1].innerHTML = o.querySelector("label").innerHTML;
        //sl.innerHTML = o.querySelector("label").innerHTML;
        //e.target.nextElementSibling.innerText = o.querySelector("label").innerHTML;
      });

    });

    nodeList[2].addEventListener("keyup", function(e) {
      filterList(e.target.value);
    });

    if (nodeList[0].classList.contains("_active")) {
      const inputBox = nodeList[2].firstChild;
      inputBox.focus();
    }*/
  })
})



const filterList = searchTerm => {
  searchTerm = searchTerm.toLowerCase();
  selected_options.forEach(option => {
    let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
    if (label.indexOf(searchTerm) != -1) {
      option.style.display = "block";
    } else {
      option.style.display = "none";
    }
  });
}



/*const optionsContainer = document.querySelector("._options-container");
const searchBox = document.querySelector("._search-box input");

const optionsList = document.querySelectorAll("._option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("_active");

  searchBox.value = "";
  filterList("");

  if (optionsContainer.classList.contains("_active")) {
    searchBox.focus();
  }
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("_active");
  });
});

searchBox.addEventListener("keyup", function(e) {
  filterList(e.target.value);
});

const filterList = searchTerm => {
  searchTerm = searchTerm.toLowerCase();
  optionsList.forEach(option => {
    let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
    if (label.indexOf(searchTerm) != -1) {
      option.style.display = "block";
    } else {
      option.style.display = "none";
    }
  });
};*/