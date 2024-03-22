$(document).ready(function()
{
    const element =
    `<header class="header">
    <div class="headerContentContainer">
      <div class="searchBarContainer">
        <div class="searchBar">
          <input class="searchBarInput" placeholder="Fedezd fel kínálatunkat!"></input>
          <button class="searchButton">
            <object class="searchIcon" data="assets/search.svg"></object>
          </button>
        </div>
      </div>
      <div class="underContainer">
        <object class="logo" data="assets/logo.svg"></object>
        <div class="headerButtonsContainer">
          <button class="headerButton">
            <object class="headerButtonIcon" data="assets/user.svg"></object>
          </button>
            <button class="headerButton">
              <object class="headerButtonIcon" data="assets/cart.svg"></object>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="linksContainer">
      <a class="linkItem">
        <label class="linkItemText">PC</label>
      </a>
      <a class="linkItem">
        <label class="linkItemText">Playstation</label>
      </a>
      <a class="linkItem">
        <label class="linkItemText">Xbox</label>
      </a>
      <a class="linkItem">
        <label class="linkItemText">Nintendo</label>
      </a>
    </div>
    </header>`;

    $("#header").replaceWith(element);
})