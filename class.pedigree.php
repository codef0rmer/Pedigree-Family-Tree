<?php
    class Pedigree {
        public function render()
        {
            $arrPedigree = array(
                array(
                    'name' => 'Parent',
                    'children' => array(
                        array(
                            'name' => 'Child 1',
                            'children' => array(
                                array(
                                    'name' => 'Sub Child 11',
                                    'children' => array(
                                        array(
                                            'name' => 'Sub Sub Child 111',
                                        ),
                                        array(
                                            'name' => 'Sub Sub Child 112',
                                        ),
                                    )
                                ),
                                array(
                                    'name' => 'Sub Child 12'
                                )
                            )
                        ),
                        array(
                            'name' => 'Child 2',
                            'children' => array(
                                array(
                                    'name' => 'Sub Child 21'
                                ),
                                array(
                                    'name' => 'Sub Child 22'
                                )
                            )
                        )
                    )
                )
            );
            echo "<style>
                    .pedigree_node {
                        border: 1px solid #99BBE8;
                        background-color: #CCDDF4;
                    }
                    .tree_vertical_line {
                        background-image: url(images/tree_line.gif);
                        background-repeat: repeat-y;
                        background-position: center top;
                    }
                    .tree_horizontal_line {
                        background-image: url(images/tree_line.gif);
                        background-repeat: repeat-x;
                        background-position: left top;
                    }
                    .tree_horizontal_line_valign_middle {
                        background-image: url(images/tree_line_2px.gif);
                        background-repeat: repeat-x;
                        background-position:left center}
                    .tree_right_line {
                        border-right-width: 1px;
                        border-right-style: solid;
                        border-right-color: #C6C6C6;
                    }
                    .tree_left_top_line {
                        border-top-width: 1px;
                        border-top-style: solid;
                        border-top-color: #C6C6C6;
                        border-left-width: 1px;
                        border-left-style: solid;
                        border-left-color: #C6C6C6;
                    }
                    .tree_right_top_line {
                        border-top-width: 1px;
                        border-top-style: solid;
                        border-top-color: #C6C6C6;
                        border-right-width: 1px;
                        border-right-style: solid;
                        border-right-color: #C6C6C6;
                    }
                </style>
                <div style='width:850px;overflow:auto;border:1px solid #000000;'>
                    <table width='100%' border='0' align='center' cellpadding='0' cellspacing='5'>
                        <tr>".$this->createNode($arrPedigree)."</tr>
                    </table>
                </div>";
        }

        public function createNode($arrPedigree)
        {
            if (is_array($arrPedigree)) {
                $heredoc = '';
                foreach ($arrPedigree as $nodeKey => $nodeValue) {
                    $cntChild = @count($arrPedigree[$nodeKey]['children']);
                    $heredoc.= "<td valign='top' align='center'>
                                    <table width='100' border='0' align='center' cellpadding='0' cellspacing='2'>
                                        <tr valign='top'  align='center'>
                                            <td align='center' width='100%' colspan='{$cntChild}' valign='top'>
                                                <table style='cursor:pointer' width='150' height='100%' border='0' align='center' cellpadding='0' cellspacing='5' class='pedigree_node'>
                                                    <tr>
                                                        <td align='center' valign='middle' width='100%' >
                                                            <strong>{$arrPedigree[$nodeKey]['name']}</strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>";
                    if ($cntChild != 0) {
                        if ($cntChild == 1) {
                            $heredoc.= "<tr><td class='tree_vertical_line' height='20'>&nbsp;</td></tr>";
                        } else {
                            $heredoc.= "<tr><td class='tree_vertical_line' height='20' colspan='{$cntChild}'>&nbsp;</td></tr><tr>";
                            for ($i = 1; $i <= $cntChild; $i++) {
                                if ($i == 1) {
                                    $className1 = '';
                                } else {
                                    $className1 = 'tree_right_top_line';
                                }

                                if ($i == $cntChild) {
                                    $className2 = '';
                                } else {
                                    $className2 = 'tree_left_top_line';
                                }
                                $heredoc.= "<td height='20'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td width='50%' class='{$className1}'>&nbsp;</td>
                                                        <td width='50%' class='{$className2}'>&nbsp;</td>
                                                    </tr>
                                                </table>
                                             </td>";
                            }
                            $heredoc.= '</tr>';
                        }
                        $heredoc.= $this->createNode($arrPedigree[$nodeKey]['children']);
                    }
                    $heredoc.= '</table></td>';
                }
                return $heredoc;
            }
        }
    }
