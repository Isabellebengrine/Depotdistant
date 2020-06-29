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

/*5e req: clients dt CA > 30.000*
NB d'abord j'ai changé le nom de la table de 'order details' à 'orderdetails' sans espace car sinon j'arrivais pas à écrire req - 
de tts façons c'est pas conseillé de mettre noms avec un espace*/

SELECT CompanyName AS 'Client', SUM(orderdetails.UnitPrice * orderdetails.Quantity) AS 'CA', Country AS 'Pays' FROM customers
JOIN orders ON orders.CustomerID = customers.CustomerID
JOIN orderdetails ON orderdetails.OrderID = orders.OrderID
GROUP BY  CompanyName
HAVING SUM(orderdetails.UnitPrice * orderdetails.Quantity)> 30000
ORDER BY SUM(orderdetails.UnitPrice * orderdetails.Quantity) DESC;

/*6e req: liste des pays dont clients commdé chez "Exotic Liquids"*/

SELECT DISTINCT customers.Country AS 'Pays' FROM customers
JOIN orders ON orders.CustomerID = customers.CustomerID
JOIN orderdetails ON orderdetails.OrderID = orders.OrderID
JOIN products ON products.ProductID = orderdetails.ProductID
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE suppliers.CompanyName = 'Exotic Liquids'
ORDER BY customers.Country;

/*7e req: Montant des ventes en 1997*/

SELECT SUM(UnitPrice * Quantity) AS 'Montant Ventes 97' FROM orderdetails
INNER JOIN orders ON orderdetails.OrderID = orders.OrderID
WHERE YEAR(OrderDate) = 1997
GROUP BY YEAR(OrderDate);

/*8e req: ventes en 1997 mois par mois*/

SELECT MONTH(orders.OrderDate) AS 'Mois 97', SUM(UnitPrice * Quantity) AS 'Montant Ventes' FROM orderdetails
INNER JOIN orders ON orderdetails.OrderID = orders.OrderID
WHERE YEAR(OrderDate) = 1997
GROUP BY MONTH(OrderDate);

/*9e req: date de dern cde du client 'Du monde entier' */

SELECT MAX(OrderDate) AS 'Date de dernière commande' FROM orders
INNER JOIN customers ON customers.CustomerID = orders.CustomerID
WHERE CompanyName = 'Du monde entier';

/*10e req: délai moyen de livraison en jours*/

SELECT ROUND(AVG(DATEDIFF(ShippedDate, OrderDate))) AS 'Délai moyen de livraison en jours' FROM orders;
