## Idea
Auction House NITK Application use case will simulate the process of online auction, in which the bidders bid and another bidder counterbid, the highest bidder wins.

##Explanation:

1.	The user enters the website of the online auction and sees all the available products that are being auctioned by the auctioneer (seller).

2.	If the user have not registered to the website, the user is redirected to the register page, when a user registers, 5 complimentary token is given. Else, the user logs in by inputting their user ID and password to be able to bid to a product. 
A user can buy a token at any point of time he/she is logged in.

3.	The users would then be able to see all the available products to be auctioned and the remaining time to bid on the object.

4.	If a user have a desired object to bid, the user can bid by clicking on the bid button below the desired item, the system would detect the user who bids and increments the current bidding price by a fixed amount. The user token counter would be reduced by one whenever the user bids, if a user has no tokens left, the user is not able to bid. 
Many users can be online at the same time and can bid on the same item.

5.	When a user bids an item, the remaining time would increase by a fixed amount, the process repeats whenever a user bids. 
The user can bid so long as there is remaining time left.

6.	The final bidder when the time runs out would be declared the winner of the auction, and will have to pay the final bidding price to the seller. 
The record of the transaction will be saved in the database of the system.

7.	When the transaction is finished and all of the apparent expenses have been paid, the auctioneer sends the item to the user via mail.



[SAMPLE USER AND PASSWORD: "iris" , "password"]
[ADMIN USER AND PASSWORD: "admin" , "password"]

## Features:	
1.      Users can view products that are for auction uploaded by other users.
2.      Users can view and bid for a product multiple times before the deadline.
3.      Once the deadline for a product is met the user with the highest bid should be given an option to “Claim” the item.
4.      Dashboard for users to view all their claimed items.
5.      Dashboard for users to view all items which they upload for auction.

## Bugs:
1.      Connection problem sometimes arrises while running the php session
2.      Works Best on the XAMP Server

##References:
W3School, WordPress, stackoverflow, Google, YouTube
