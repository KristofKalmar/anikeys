<?php
function generateRowListItem($themeColor)
{
    $img = "assets/avatar.jpg";
    $title = "Avatar Frontiers of Pandora (Standard edition) - PS5";
    $price = "27,490 Ft";

    return '
        <div class="rowListItem" style="background-color: ' . $themeColor . '">
            <a href="productDetails.html" class="rowListItemImageContainer">
                <img class="rowListItemImg" src="' . $img . '" />
            </a>
            <div class="rowListItemDataContainer">
                <div class="rowListItemTitle">' . $title . '</div>
                <div class="rowListItemCartButtonContainer">
                    <a class="rowListItemCartButton">
                        Kosárba
                    </a>
                    <div class="rowListItemPrice">' . $price . '</div>
                </div>
            </div>
        </div>';
}

function populateRowList($number)
{
    if (isset($_POST['data']) && is_array($_POST['data'])) {
        $replaceElements = $_POST['data'];

        $finalElements = [];

        foreach ($replaceElements as $element) {
            $element1 = '
            <div class="rowListContainer' . ($element['data-multiLine'] === 'true' ? " rowList_multiLine" : "") . '">
                <div class="rowListVerticalContainer">
                    <div class="contentVerticalContainer">
                        <div class="contentTitleContainer">
                            <object class="rowListTitleLogo" data="assets/' . $element['data-logo'] . '"></object>
                            ' . $element['data-title'] . '
                            <div class="rowListDivider"></div>
                        </div>
                        <div class="contentItemsContainer">';

            $element2 = '';

            for ($i = 0; $i < $number; $i++) {
                $element2 .= generateRowListItem($element['data-themeColor']);
            }

            $element3 = '
                        </div>
                    </div>
                </div>
            </div>';

            $finalElements[] = $element1 . $element2 . $element3;
        }

        foreach ($replaceElements as $index => $element) {
            $replaceElements[$index]['innerHTML'] = $finalElements[$index];
        }

        echo json_encode($replaceElements);
    } else {
        echo "Hiba: Nem érkezett megfelelő adat.";
    }
}

populateRowList(16);
?>