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
          <div class="headerButton">
            <object class="headerButtonIcon" data="assets/user.svg"></object>
          </div>
          <div class="headerButton">
            <object class="headerButtonIcon" data="assets/cart.svg"></object>
          </div>
        </div>
      </div>
    </div>
    <div class="linksContainer">
      <div class="linkItem">
        <label class="linkItemText">PC</label>
      </div>
      <div class="linkItem">
        <label class="linkItemText">Playstation</label>
      </div>
      <div class="linkItem">
        <label class="linkItemText">Xbox</label>
      </div>
      <div class="linkItem">
        <label class="linkItemText">Nintendo</label>
      </div>
    </div>
    </header>`;

    $("#header").replaceWith(element);
})