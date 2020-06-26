/* NB. a modifier pour que script de création fonctionne:
1e ligne:
DROP DATABASE `northwind`;
doit dire
DROP DATABASE IF EXISTS ...
*/

/*1e requête : liste des contacts français
NB. Tous résultats s'affichent comme dans l'énoncé mais sans les accents donc il faut changer l'encodage avec UTF...
*/

SELECT CompanyName AS 'Société', ContactName AS 'Contact', ContactTitle AS 'Fonction', Phone AS 'Téléphone' FROM customers
WHERE Country = 'France';


/*2e req: pdts vendus par Exotic Liquids*/

SELECT ProductName AS 'Produit', UnitPrice AS 'Prix' FROM products
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE CompanyName = 'Exotic Liquids';

/*3e req: nb pdts vendus par fournis fcs dans ordre DESC*/

SELECT CompanyName AS 'Fournisseur', COUNT(products.ProductID) AS 'Nbre produits' FROM suppliers
JOIN products ON products.SupplierID = suppliers.SupplierID
WHERE suppliers.Country = 'France'
GROUP BY CompanyName
ORDER BY COUNT(products.ProductID) DESC;

/*4e req: liste clients francais avec + de 10 commandes*/

SELECT CompanyName AS 'Client', COUNT(orders.OrderID) AS 'Nbre commandes' FROM customers
JOIN orders ON orders.CustomerID = customers.CustomerID
WHERE customers.Country = 'France'
GROUP BY CompanyName
HAVING COUNT(orders.OrderID) > 10;

/*5e req: clients dt CA > 30.000*/

SELECT CompanyName AS 'Client', SUM(orderdetails.UnitPrice * orderdetails.Quantity) AS 'CA', Country AS 'Pays' FROM customers
JOIN orders ON orders.CustomerID = customers.CustomerID
JOIN orderdetails ON orderdetails.OrderID = orders.OrderID
GROUP BY  CompanyName
HAVING SUM(orderdetails.UnitPrice * orderdetails.Quantity)> 30000
ORDER BY SUM(orderdetails.UnitPrice * orderdetails.Quantity) DESC;

