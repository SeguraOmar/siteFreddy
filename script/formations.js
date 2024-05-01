document.getElementById('SearchButton').addEventListener('click', function() {
    var category = document.getElementById('category').value;
    if (category === 'IA') {
        document.getElementById('searchForm').action = '../controllers/controller-IA.php';
    } else if (category === 'Cloud') {
        document.getElementById('searchForm').action = '../controllers/controller-cloud.php';
    }
    document.getElementById('searchForm').submit();
});