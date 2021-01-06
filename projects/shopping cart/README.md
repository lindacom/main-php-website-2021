Add shipping cost to total

```
<tr>
<td colspan "4">Shipping</td>

<td> <?php 
if($total < 75) {
echo '$10';
$total += 10;
} else {
echo 'free';
}
?>
</td>
</tr>
