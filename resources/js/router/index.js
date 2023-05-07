import { createRouter, createWebHistory } from "vue-router";

import NotFound from '../NotFound.vue';
import PageLoader from '../pages/ecomrade/PageLoader.vue';
import Home from "../pages/ecomrade/Home.vue";
import Event from "../pages/ecomrade/Event.vue";
import Blog from "../pages/ecomrade/Blog.vue";
import ViewBlog from "../pages/ecomrade/ViewBlog.vue";
import ViewClub from "../pages/ecomrade/ViewClub.vue";
import ClubDetails from "../pages/ecomrade/ClubDetails.vue";
import ChatUser from "../pages/ecomrade/ChatUser.vue";
import ViewResource from "../pages/ecomrade/ViewResource.vue";
import ViewEvent from "../pages/ecomrade/ViewEvent.vue";
import ViewPost from "../pages/ecomrade/ViewPost.vue";
import ViewCart from "../pages/ecomrade/ViewCart.vue";
import ViewAcceptedConnect from "../pages/ecomrade/ViewAcceptedConnect.vue";
import ViewReceivedConnect from "../pages/ecomrade/ViewReceivedConnect.vue";
import ViewSentConnect from "../pages/ecomrade/ViewSentConnect.vue";
import CreateBlog from "../pages/ecomrade/CreateBlog.vue";
import CreateBlogClub from "../pages/ecomrade/CreateBlogClub.vue";
import SeeBlogClub from "../pages/ecomrade/SeeBlogClub.vue";
import CreateMarketClub from "../pages/ecomrade/CreateMarketClub.vue";
import SeeMarketClub from "../pages/ecomrade/SeeMarketClub.vue";
import CreateEventClub from "../pages/ecomrade/CreateEventClub.vue";
import SeeEventClub from "../pages/ecomrade/SeeEventClub.vue";
import CreatePollClub from "../pages/ecomrade/CreatePollClub.vue";
import SeePollClub from "../pages/ecomrade/SeePollClub.vue";
import CreateResourceClub from "../pages/ecomrade/CreateResourceClub.vue";
import SeeResourceClub from "../pages/ecomrade/SeeResourceClub.vue";
import CreateClub from "../pages/ecomrade/CreateClub.vue";
import CreateResource from "../pages/ecomrade/CreateResource.vue";
import CreateEvent from "../pages/ecomrade/CreateEvent.vue";
import CreateMarket from "../pages/ecomrade/CreateMarket.vue";
import CreatePoll from "../pages/ecomrade/CreatePoll.vue";
import CreateRental from "../pages/ecomrade/CreateRental.vue";
import EditBlog from "../pages/ecomrade/EditBlog.vue";
import EditClub from "../pages/ecomrade/EditClub.vue";
import EditResource from "../pages/ecomrade/EditResource.vue";
import EditEvent from "../pages/ecomrade/EditEvent.vue";
import EditMarket from "../pages/ecomrade/EditMarket.vue";
import EditPoll from "../pages/ecomrade/EditPoll.vue";
import EditRental from "../pages/ecomrade/EditRental.vue";
import EditProfile from "../pages/ecomrade/EditProfile.vue";
import EditPassword from "../pages/ecomrade/EditPassword.vue";
import CreateBlogCategory from "../pages/ecomrade/CreateBlogCategory.vue";
import CreateMarketCategory from "../pages/ecomrade/CreateMarketCategory.vue";
import CreateRentalCategory from "../pages/ecomrade/CreateRentalCategory.vue";
import CreateLocation from "../pages/ecomrade/CreateLocation.vue";
import CreateYear from "../pages/ecomrade/CreateYear.vue";
import CreateCourse from "../pages/ecomrade/CreateCourse.vue";
import CreateMarketSubCategory from "../pages/ecomrade/CreateMarketSubCategory.vue";
import PolishBlogCategory from "../pages/ecomrade/PolishBlogCategory.vue";
import PolishMarketCategory from "../pages/ecomrade/PolishMarketCategory.vue";
import PolishRentalCategory from "../pages/ecomrade/PolishRentalCategory.vue";
import PolishLocation from "../pages/ecomrade/PolishLocation.vue";
import PolishYear from "../pages/ecomrade/PolishYear.vue";
import PolishCourse from "../pages/ecomrade/PolishCourse.vue";
import PolishMarketSubCategory from "../pages/ecomrade/PolishMarketSubCategory.vue";
import Club from "../pages/ecomrade/Club.vue";
import Resource from "../pages/ecomrade/Resource.vue";
import Contact from "../pages/ecomrade/Contact.vue";
import Terms from "../pages/ecomrade/Terms.vue";
import Privacy from "../pages/ecomrade/Privacy.vue";
import Push from "../pages/ecomrade/Push.vue";
import Faq from "../pages/ecomrade/Faq.vue";
import Login from "../pages/ecomrade/Login.vue";
import Market from "../pages/ecomrade/Market.vue";
import ViewProd from "../pages/ecomrade/ViewProd.vue";
import ViewMarket from "../pages/ecomrade/ViewMarket.vue";
import Poll from "../pages/ecomrade/Poll.vue";
import ViewPoll from "../pages/ecomrade/ViewPoll.vue";
import Profile from "../pages/ecomrade/Profile.vue";
import Prof from "../pages/ecomrade/Prof.vue";
import User from "../pages/ecomrade/User.vue";
import ProdProfile from "../pages/ecomrade/ProdProfile.vue";
import BlogProfile from "../pages/ecomrade/BlogProfile.vue";
import PollProfile from "../pages/ecomrade/PollProfile.vue";
import ClubProfile from "../pages/ecomrade/ClubProfile.vue";
import Register from "../pages/ecomrade/Register.vue";
import Rental from "../pages/ecomrade/Rental.vue";
import ViewRental from "../pages/ecomrade/ViewRental.vue";
import ViewHouse from "../pages/ecomrade/ViewHouse.vue";
import AdmDashboard from "../pages/ecomrade/AdmDashboard.vue";
import AdmUser from "../pages/ecomrade/AdmUser.vue";
import SearchUser from "../pages/ecomrade/SearchUser.vue";
import AdmBlog from "../pages/ecomrade/AdmBlog.vue";
import AdmBlogCat from "../pages/ecomrade/AdmBlogCat.vue";
import AdmClub from "../pages/ecomrade/AdmClub.vue";
import AdmEvent from "../pages/ecomrade/AdmEvent.vue";
import AdmEventReport from "../pages/ecomrade/AdmEventReport.vue";
import AdmRentalReport from "../pages/ecomrade/AdmRentalReport.vue";
import AdmRentalBooking from "../pages/ecomrade/AdmRentalBooking.vue";
import AdmEventBooking from "../pages/ecomrade/AdmEventBooking.vue";
import AdmFeed from "../pages/ecomrade/AdmFeed.vue";
import AdmMarketReport from "../pages/ecomrade/AdmMarketReport.vue";
import AdmLocation from "../pages/ecomrade/AdmLocation.vue";
import AdmYear from "../pages/ecomrade/AdmYear.vue";
import AdmCourse from "../pages/ecomrade/AdmCourse.vue";
import AdmMarket from "../pages/ecomrade/AdmMarket.vue";
import AdmResource from "../pages/ecomrade/AdmResource.vue";
import AdmPoll from "../pages/ecomrade/AdmPoll.vue";
import AdmMarketCat from "../pages/ecomrade/AdmMarketCat.vue";
import AdmMarketSubCat from "../pages/ecomrade/AdmMarketSubCat.vue";
import AdmRental from "../pages/ecomrade/AdmRental.vue";
import AdmRentalCat from "../pages/ecomrade/AdmRentalCat.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        meta: {
            title: 'Home page - The Social Hub for Campus Students',
            description: 'Connect, network and collaborate with other Kenyan campus students. Find student associations, events, e-market, polls, clubs, societies, and rentals.',
            keywords: 'ecomrade, Kenyan campus students, Social hub, Students, Student associations, Events, Student associations, e-market, polls, clubs, societies, rentals, Campus life, Campus networking',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Home page - ecomrade',
            ogImage: '/logo.png',
            ogDescription: 'The social hub for Kenyan campus students. Connect, network and collaborate. Find student associations, events, e-market, polls, clubs, societies, and rentals.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/event",
        name: "Event",
        component: Event,
        meta: {
            title: 'Events :- ecomrade',
            description: 'Discover and attend the best events, concerts, workshops, and festivals on our platform. RSVP, buy tickets, and enjoy entertainment, culture, and more.',
            keywords: 'Events, Parties, Concerts, Festivals, Workshops, Seminars, Conferences, Networking, Collaboration, Entertainment, Music, Arts, Culture, Food and beverage, Performances, Exhibitions, Sports, Outdoor activities, Charity events, Volunteer opportunities, Fundraisers, Social gatherings, Public events, Private events, RSVP, Tickets, Venue',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Events - ecomrade',
            ogImage: '/img/event.webp',
            ogDescription: 'Discover and attend the best events, concerts, workshops, and festivals on our platform. RSVP, buy tickets, and enjoy entertainment, culture, and more.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/blog",
        name: "Blog",
        component: Blog,
        meta: {
            title: 'Blogs :- ecomrade',
            description: 'Explore the creativity and perspectives of Kenyan comrades through our blogs. Share personal experiences, opinions, and critiques on culture, arts, and more.',
            keywords: 'Blogs, Comrades, Writing, Creativity, Personal experiences, Reflection, Perspectives, Opinion pieces, Reviews, Critiques, Culture, Arts, Music, Literature, Film, TV, Lifestyle, Health and wellness, Food and beverage, Fashion, Travel, Technology, Science, Business, Finance, Politics',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Blogs - ecomrade',
            ogImage: '/img/blog.jpg',
            ogDescription: 'Explore the creativity and perspectives of Kenyan comrades through our blogs. Share personal experiences, opinions, and critiques on culture, arts, and more.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewBlog:slug",
        name: "ViewBlog",
        component: ViewBlog,
        props: true,
        meta: {
            title: 'View blog :- ecomrade',
            description: 'Join me on ecomrade blog platform and share your thoughts, experiences, and creativity with Kenyan comrades. Do not forget to read, comment, and rate my blog too!',
            keywords: 'Blogs, Comrades, Writing, Creativity, Personal experiences, Reflection, Perspectives, Opinion pieces, Reviews, Critiques, Culture, Arts, Music, Literature, Film, TV, Lifestyle, Health and wellness, Food and beverage, Fashion, Travel, Technology, Science, Business, Finance, Politics',
            author: 'ecomrade blogger',
            robots: 'index, follow',
            ogTitle: 'View blog - ecomrade',
            ogImage: '/img/blog.jpg',
            ogDescription: 'Join me on ecomrade blog platform and share your thoughts, experiences, and creativity with Kenyan comrades. Do not forget to read, comment, and rate my blog too!',
            favicon: '/favicon.ico'
        },

    },

    {
        path: "/viewResource:slug",
        name: "ViewResource",
        component: ViewResource,
        props: true,
        meta: {
            title: 'View Learning Resource :- ecomrade',
            description: 'Explore ecomrade\'s learning resources and expand your knowledge on a variety of topics. From academic subjects to personal development, we have something for everyone.',
            keywords: 'Learning Resource, ecomrade, Knowledge, Academic, Personal development, Topics, Education, Online learning, Resources, Skills, Study, Training, Courses, Programs, Tutorials, Guides, E-books, Articles',
            author: 'ecomrade resources',
            robots: 'index, follow',
            ogTitle: 'View Learning Resource - ecomrade',
            ogImage: '/img/learningresource.webp',
            ogDescription: 'Explore ecomrade\'s learning resources and expand your knowledge on a variety of topics. From academic subjects to personal development, we have something for everyone.',
            favicon: '/favicon.ico'
        },

    },

    {
        path: "/viewEvent:slug",
        name: "ViewEvent",
        component: ViewEvent,
        props: true,
        meta: {
            title: 'View event :- ecomrade',
            description: 'Join us for an unforgettable event! Discover the best in entertainment, culture, and more. RSVP now, buy your tickets, and get ready to have a great time. See you there!',
            keywords: 'Events, Parties, Concerts, Festivals, Workshops, Seminars, Conferences, Networking, Collaboration, Entertainment, Music, Arts, Culture, Food and beverage, Performances, Exhibitions, Sports, Outdoor activities, Charity events, Volunteer opportunities, Fundraisers, Social gatherings, Public events, Private events, RSVP, Tickets, Venue',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View event - ecomrade',
            ogImage: '/img/event.webp',
            ogDescription: 'Join us for an unforgettable event! Discover the best in entertainment, culture, and more. RSVP now, buy your tickets, and get ready to have a great time. See you there!',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewPost:slug",
        name: "ViewPost",
        component: ViewPost,
        props: true,
        meta: {
            title: 'View blog :- ecomrade',
            description: 'Join me on ecomrade blog platform and share your thoughts, experiences and creativity with Kenyan comrades. Do not forget to read, comment, and rate my blog too!',
            keywords: 'Blogs, Comrades, Writing, Creativity, Personal experiences, Reflection, Perspectives, Opinion pieces, Reviews, Critiques, Culture, Arts, Music, Literature, Film, TV, Lifestyle, Health and wellness, Food and beverage, Fashion, Travel, Technology, Science, Business, Finance, Politics',
            author: 'ecomrade blogger',
            robots: 'index, follow',
            ogTitle: 'View blog - ecomrade',
            ogImage: '/img/blog.jpg',
            ogDescription: 'Join me on ecomrade blog platform and share your thoughts, experiences and creativity with Kenyan comrades. Do not forget to read, comment, and rate my blog too!',
            favicon: '/favicon.ico'
        },
    },
    
    {
        path: "/viewClub:slug",
        name: "ViewClub",
        component: ViewClub,
        props: true,
        meta: {
            title: 'Club Chat Room :- ecomrade',
            description: ' Connect with members of different clubs and societies on ecomrade chat room. Engage in discussions on various topics of interest and grow your network.',
            keywords: 'ecomrade, club chat room, society chat room, discussions, network, connect, members, topics, interests, engaging conversations.',
            author: 'ecomrade blogger',
            robots: 'index, follow',
            ogTitle: 'Club Chat Room - ecomrade',
            ogImage: '/web/chatroom.webp',
            ogDescription: ' Connect with members of different clubs and societies on ecomrade chat room. Engage in discussions on various topics of interest and grow your network.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/clubDetails:slug",
        name: "ClubDetails",
        component: ClubDetails,
        props: true,
        meta: {
            title: 'View Club :- ecomrade',
            description: 'Explore the various clubs and societies available on ecomrade, including their activities, membership requirements, and upcoming events. Join the community and connect with like-minded individuals',
            keywords: 'Clubs, Societies, Groups, Community, Membership, Activities, Events, Interests, Hobbies, Networking, Socializing, Education, Culture, Arts, Sports, Technology, Business, Environment, Volunteering, Diversity, Inclusion, Kenyan students',
            author: 'ecomrade blogger',
            robots: 'index, follow',
            ogTitle: 'View Club - ecomrade',
            ogImage: '/web/club.jpeg',
            ogDescription: 'Explore the various clubs and societies available on ecomrade, including their activities, membership requirements, and upcoming events. Join the community and connect with like-minded individuals',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/chatUser:slug",
        name: "ChatUser",
        component: ChatUser,
        props: true,
        meta: {
            title: 'Instant Messaging with Connected Comrades on ecomrade :- ecomrade',
            description: 'ecomrade\'s instant messaging feature allows you to chat with your connected comrades in real-time. Whether you want to have a private conversation with one person or group chat with multiple members, this feature provides a convenient way to communicate with others on the platform.',
            keywords: 'ecomrade, instant messaging, chatting, connected comrades, private conversations, group conversations',
            author: 'ecomrade blogger',
            robots: 'index, follow',
            ogTitle: 'Instant Messaging with Connected Comrades on ecomrade - ecomrade',
            ogImage: '/web/messaging.jpg',
            ogDescription: 'ecomrade\'s instant messaging feature allows you to chat with your connected comrades in real-time. Whether you want to have a private conversation with one person or group chat with multiple members, this feature provides a convenient way to communicate with others on the platform.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createBlogClub:slug",
        name: "CreateBlogClub",
        component: CreateBlogClub,
        props: true,
        meta: {
            title: 'Create club blog :- ecomrade',
            description: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            keywords: 'clubs, societies, groups, memberships, interests, hobbies, networking, socializing, community, events, discussions.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create club blog - ecomrade',
            ogImage: '/img/createblog.png',
            ogDescription: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/seeBlogClub:slug",
        name: "SeeBlogClub",
        component: SeeBlogClub,
        props: true,
        meta: {
            title: 'View club blog :- ecomrade',
            description: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            keywords: 'clubs, societies, groups, memberships, interests, hobbies, networking, socializing, community, events, discussions.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View club blog - ecomrade',
            ogImage: '/img/createblog.png',
            ogDescription: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createMarketClub:slug",
        name: "CreateMarketClub",
        component: CreateMarketClub,
        props: true,
        meta: {
            title: 'Advertise Club Products and Services :- ecomrade',
            description: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Advertise Club Products and Services - ecomrade',
            ogImage: '/img/postproducts.png',
            ogDescription: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/seeMarketClub:slug",
        name: "SeeMarketClub",
        component: SeeMarketClub,
        props: true,
        meta: {
            title: 'Club Products and Services :- ecomrade',
            description: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Club Products and Services - ecomrade',
            ogImage: '/img/postproducts.png',
            ogDescription: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createEventClub:slug",
        name: "CreateEventClub",
        component: CreateEventClub,
        props: true,
        meta: {
            title: 'Create club event :- ecomrade',
            description: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create club event - ecomrade',
            ogImage: '/img/createevents.jpg',
            ogDescription: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/seeEventClub:slug",
        name: "SeeEventClub",
        component: SeeEventClub,
        props: true,
        meta: {
            title: 'Create club event :- ecomrade',
            description: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create club event - ecomrade',
            ogImage: '/img/createevents.jpg',
            ogDescription: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createPollClub:slug",
        name: "CreatePollClub",
        component: CreatePollClub,
        props: true,
        meta: {
            title: 'Create club poll :- ecomrade',
            description: 'Create thought-provoking polls and surveys on ecomrade to collect valuable feedback and insights. Gather opinions and make data-driven decisions for personal or business purposes.',
            keywords: 'polls, surveys, opinions, feedback, data-driven decisions, ecomrade',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create club poll - ecomrade',
            ogImage: '/img/createpoll.png',
            ogDescription: 'Create thought-provoking polls and surveys on ecomrade to collect valuable feedback and insights. Gather opinions and make data-driven decisions for personal or business purposes.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/seePollClub:slug",
        name: "SeePollClub",
        component: SeePollClub,
        props: true,
        meta: {
            title: 'View club poll :- ecomrade',
            description: 'Join poll now and cast your vote! Share it with your friends to get more opinions.',
            keywords: 'Polls, Surveys, Feedback, Voting, Questionnaires, Opinions, Data collection, Market research, Public opinion, User engagement, User feedback, User experience, User interface, Social media, Analytics, Results, Reports, Insights, Trends, Demographics, Target audience, Customized polls, Multiple choice, Rating scales, Open-ended questions, Anonymous voting, Poll expiration, Poll sharing, Poll moderation, Poll embedding',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View club poll - ecomrade',
            ogImage: '/img/poll.png',
            ogDescription: 'Join poll now and cast your vote! Share it with your friends to get more opinions.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createResourceClub:slug",
        name: "CreateResourceClub",
        component: CreateResourceClub,
        props: true,
        meta: {
            title: 'Post Club Resource :- ecomrade',
            description: 'Discover comprehensive learning resources on ecomrade. Access a variety of educational materials on various topics, all in one place.',
            keywords: 'Learning Resource, Education, E-Learning, Online courses, Tutorials, Study materials, Study groups, Knowledge, Skills, Certifications, Career development.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Post Club Resource - ecomrade',
            ogImage: '/img/learningresource.png',
            ogDescription: 'Discover comprehensive learning resources on ecomrade. Access a variety of educational materials on various topics, all in one place.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/seeResourceClub:slug",
        name: "SeeResourceClub",
        component: SeeResourceClub,
        props: true,
        meta: {
            title: 'View Club Resource :- ecomrade',
            description: 'Explore ecomrade\'s learning resources and expand your knowledge on a variety of topics. From academic subjects to personal development, we have something for everyone.',
            keywords: 'Learning Resource, ecomrade, Knowledge, Academic, Personal development, Topics, Education, Online learning, Resources, Skills, Study, Training, Courses, Programs, Tutorials, Guides, E-books, Articles',
            author: 'ecomrade resources',
            robots: 'index, follow',
            ogTitle: 'View Club Resource - ecomrade',
            ogImage: '/img/learningresource.webp',
            ogDescription: 'Explore ecomrade\'s learning resources and expand your knowledge on a variety of topics. From academic subjects to personal development, we have something for everyone.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewCart",
        name: "ViewCart",
        component: ViewCart,
        props: true,
        meta: {
            title: 'My cart :- ecomrade',
            description: 'Welcome to ecomrade cart! Shop the best deals on Kenyan student essentials including accessories, electronics, and more. Conveniently checkout with just a few clicks.',
            keywords: 'ecomrade Cart, Shopping, Kenyan student essentials, Textbooks, Electronics, Gadgets, Stationery, Clothing, Accessories, Deals, Discounts, Convenience, Online Payment, Secure Checkout, Customer Support, Returns and Refunds, User-friendly Interface, Wishlist, Shopping Cart, Product Reviews, Recommendations, Sale',
            author: 'ecomrade cart',
            robots: 'index, follow',
            ogTitle: 'My cart - ecomrade',
            ogImage: '/logo.png',
            ogDescription: 'Welcome to ecomrade cart! Shop the best deals on Kenyan student essentials including accessories, electronics, and more. Conveniently checkout with just a few clicks.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewAcceptedConnect",
        name: "ViewAcceptedConnect",
        component: ViewAcceptedConnect,
        props: true,
        meta: {
            title: 'Accepted Connections from Other Comrades on ecomrade :- ecomrade',
            description: 'The Accepted Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            keywords: 'ecomrade, received connections, chat room, communication, networking, professional relationships',
            author: 'ecomrade cart',
            robots: 'index, follow',
            ogTitle: 'Accepted Connections from Other Comrades on ecomrade - ecomrade',
            ogImage: '/logo.png',
            ogDescription: 'The Accepted Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewReceivedConnect",
        name: "ViewReceivedConnect",
        component: ViewReceivedConnect,
        props: true,
        meta: {
            title: 'Received Connections from Other Comrades on ecomrade :- ecomrade',
            description: 'The Received Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            keywords: 'ecomrade, received connections, chat room, communication, networking, professional relationships',
            author: 'ecomrade cart',
            robots: 'index, follow',
            ogTitle: 'Received Connections from Other Comrades on ecomrade - ecomrade',
            ogImage: '/logo.png',
            ogDescription: 'The Received Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewSentConnect",
        name: "ViewSentConnect",
        component: ViewSentConnect,
        props: true,
        meta: {
            title: 'Sent Connects from Other Comrades on ecomrade :- ecomrade',
            description: 'The Received Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            keywords: 'ecomrade, sent connections, chat room, communication, networking, professional relationships',
            author: 'ecomrade cart',
            robots: 'index, follow',
            ogTitle: 'Sent Connects from Other Comrades on ecomrade - ecomrade',
            ogImage: '/logo.png',
            ogDescription: 'The Received Connections chat room on ecomrade allows users to communicate and interact with other members who have sent them connection requests. This feature is a great way to expand ones network and build professional relationships.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/viewRental:slug",
        name: "ViewRental",
        component: ViewRental,
        meta: {
            title: 'View Rental :- ecomrade',
            description: 'Browse and view available rental properties on ecomrade, including affordable, safe, and secure options around campus. Find your ideal rental through our platform.',
            keywords: 'ecomrade rental, view rental, rental properties, campus rentals, affordable rentals, safe rentals, secure rentals',
            author: 'ecomrade rentals',
            robots: 'index, follow',
            ogTitle: 'View Rental - ecomrade',
            ogImage: '/web/rental.jpg',
            ogDescription: 'Browse and view available rental properties on ecomrade, including affordable, safe, and secure options around campus. Find your ideal rental through our platform.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/viewHouse:slug",
        name: "ViewHouse",
        component: ViewHouse,
        meta: {
            title: 'View Rental :- ecomrade',
            description: 'Browse and view available rental properties on ecomrade, including affordable, safe, and secure options around campus. Find your ideal rental through our platform.',
            keywords: 'ecomrade rental, view rental, rental properties, campus rentals, affordable rentals, safe rentals, secure rentals',
            author: 'ecomrade rentals',
            robots: 'index, follow',
            ogTitle: 'View Rental - ecomrade',
            ogImage: '/web/rental.jpg',
            ogDescription: 'Browse and view available rental properties on ecomrade, including affordable, safe, and secure options around campus. Find your ideal rental through our platform.',
            favicon: '/favicon.ico'
        },
    },
    
    {
        path: "/viewPoll:slug",
        name: "ViewPoll",
        component: ViewPoll,
        props: true,
        meta: {
            title: 'View poll :- ecomrade',
            description: 'Join poll now and cast your vote! Share it with your friends to get more opinions.',
            keywords: 'Polls, Surveys, Feedback, Voting, Questionnaires, Opinions, Data collection, Market research, Public opinion, User engagement, User feedback, User experience, User interface, Social media, Analytics, Results, Reports, Insights, Trends, Demographics, Target audience, Customized polls, Multiple choice, Rating scales, Open-ended questions, Anonymous voting, Poll expiration, Poll sharing, Poll moderation, Poll embedding',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View poll - ecomrade',
            ogImage: '/img/poll.png',
            ogDescription: 'Join poll now and cast your vote! Share it with your friends to get more opinions.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/viewProd:slug",
        name: "ViewProd",
        component: ViewProd,
        props: true,
        meta: {
            title: 'View product :- ecomrade',
            description: 'Check out my amazing product! Buy it now and share with your friends.',
            keywords: 'E-marketplace, Online marketplace, Buying, Selling, Trade, Barter, Goods, Services, Products, Merchandise, Second-hand, Used, New, Discounts, Deals, Coupons, Offers, Negotiation, Transactions, Cash, Local pickup, Delivery, Trade-in, Donation',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View product - ecomrade',
            ogImage: '/assets/images/demos/denim.jpg',
            ogDescription: 'Check out my amazing product! Buy it now and share with your friends.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/viewMarket:slug",
        name: "ViewMarket",
        component: ViewMarket,
        props: true,
        meta: {
            title: 'View product :- ecomrade',
            description: 'Check out my amazing product! Buy it now and share with your friends.',
            keywords: 'E-marketplace, Online marketplace, Buying, Selling, Trade, Barter, Goods, Services, Products, Merchandise, Second-hand, Used, New, Discounts, Deals, Coupons, Offers, Negotiation, Transactions, Cash, Local pickup, Delivery, Trade-in, Donation',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View product - ecomrade',
            ogImage: '/assets/images/demos/denim.jpg',
            ogDescription: 'Check out my amazing product! Buy it now and share with your friends.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/profile:slug",
        name: "Profile",
        component: Profile,
        props: true,
        meta: {
            title: 'View profile :- ecomrade',
            description: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            keywords: 'Profile creation, Profile information, Profile customization, Profile settings, Profile picture, Bio, Interests, Friends, Followers, Following, Social network',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View profile - ecomrade',
            ogImage: '/img/profile.jpg',
            ogDescription: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/prof:slug",
        name: "Prof",
        component: Prof,
        props: true,
        meta: {
            title: 'View profile :- ecomrade',
            description: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            keywords: 'Profile creation, Profile information, Profile customization, Profile settings, Profile picture, Bio, Interests, Friends, Followers, Following, Social network',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View profile - ecomrade',
            ogImage: '/img/profile.jpg',
            ogDescription: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/user:slug",
        name: "User",
        component: User,
        props: true,
        meta: {
            title: 'View profile :- ecomrade',
            description: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            keywords: 'Profile creation, Profile information, Profile customization, Profile settings, Profile picture, Bio, Interests, Friends, Followers, Following, Social network',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'View profile - ecomrade',
            ogImage: '/img/profile.jpg',
            ogDescription: 'Connect with me on ecomrade! Check out my profile and let us be friends.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/prodprofile:slug",
        name: "ProdProfile",
        component: ProdProfile,
        props: true,
        meta: {
            title: 'Profile Products :- ecomrade',
            description: 'Discover a diverse range of products that I offer by browsing through my profile. Find everything you need in one place. Stay up-to-date with my latest offerings and avail exciting discounts by following my profile.',
            keywords: 'Products, Inventory, Merchandise, Listings, Catalogue, Shop, Store, Offerings, Items for sale, Available products, Stock, Assortment, Collection, Assorted goods',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Profile Products - ecomrade',
            ogImage: '/img/prodlist.jpg',
            ogDescription: 'Discover a diverse range of products that I offer by browsing through my profile. Find everything you need in one place. Stay up-to-date with my latest offerings and avail exciting discounts by following my profile.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/blogprofile:slug",
        name: "BlogProfile",
        component: BlogProfile,
        props: true,
        meta: {
            title: 'Profile Blog Posts :- ecomrade',
            description: 'Get to know me better by exploring my personal blog on my ecomrade profile. From personal experiences to critiques of culture and arts, my blog is a reflection of my unique perspective.',
            keywords: 'Blog posts, Personal experiences, Opinions, Reviews, Critiques, Creativity, Perspectives, Culture, Arts, Lifestyle, Writing, Expression, Reflections, Stories, Share',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Profile Blog Posts - ecomrade',
            ogImage: '/img/bloglist.webp',
            ogDescription: 'Get to know me better by exploring my personal blog on my ecomrade profile. From personal experiences to critiques of culture and arts, my blog is a reflection of my unique perspective.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/pollprofile:slug",
        name: "PollProfile",
        component: PollProfile,
        props: true,
        meta: {
            title: 'Profile Polls :- ecomrade',
            description: 'Explore my profile for a comprehensive list of polls that I have created. Share your opinion and engage in thought-provoking discussions.',
            keywords: 'Polls, Surveys, Feedback, Opinions, Voting, Responses, User engagement, Data collection, Market research, Insights, Analysis',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Profile Polls - ecomrade',
            ogImage: '/img/pollList.png',
            ogDescription: 'Explore my profile for a comprehensive list of polls that I have created. Share your opinion and engage in thought-provoking discussions.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/clubprofile:slug",
        name: "ClubProfile",
        component: ClubProfile,
        props: true,
        meta: {
            title: 'Profile clubs and societies :- ecomrade',
            description: 'Check out my ecomrade profile to see the diverse range of clubs and societies I am a member of. From academic to social, find out what groups I am involved with and join the conversation.',
            keywords: 'clubs, societies, groups, memberships, interests, hobbies, networking, socializing, community, events, discussions.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Profile clubs and societies - ecomrade',
            ogImage: '/img/clubsandsocieties.png',
            ogDescription: 'Check out my ecomrade profile to see the diverse range of clubs and societies I am a member of. From academic to social, find out what groups I am involved with and join the conversation.',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/createblog",
        name: "CreateBlog",
        component: CreateBlog,
        meta: {
            title: 'Create Blog :- ecomrade',
            description: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            keywords: 'clubs, societies, groups, memberships, interests, hobbies, networking, socializing, community, events, discussions.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create Blog - ecomrade',
            ogImage: '/img/createblog.png',
            ogDescription: 'Express your thoughts, ideas, and experiences through blogs on ecomrade. Engage with other users, start conversations, and share your knowledge.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createclub",
        name: "CreateClub",
        component: CreateClub,
        meta: {
            title: 'Create Club :- ecomrade',
            description: 'Start your own club or society on ecomrade and connect with like-minded individuals. Share your interests and passions with the community. Get started today!',
            keywords: 'Create Clubs, Create Societies, ecomrade, Clubs, Societies, Interests, Passions, Community, Connections',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create Club - ecomrade',
            ogImage: '/img/createclub.jpg',
            ogDescription: 'Start your own club or society on ecomrade and connect with like-minded individuals. Share your interests and passions with the community. Get started today!',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createresource",
        name: "CreateResource",
        component: CreateResource,
        meta: {
            title: 'Create Resource :- ecomrade',
            description: 'Discover comprehensive learning resources on ecomrade. Access a variety of educational materials on various topics, all in one place.',
            keywords: 'Learning Resource, Education, E-Learning, Online courses, Tutorials, Study materials, Study groups, Knowledge, Skills, Certifications, Career development.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create Resource - ecomrade',
            ogImage: '/img/learningresource.png',
            ogDescription: 'Discover comprehensive learning resources on ecomrade. Access a variety of educational materials on various topics, all in one place.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createEvent",
        name: "CreateEvent",
        component: CreateEvent,
        meta: {
            title: 'Create event :- ecomrade',
            description: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create event - ecomrade',
            ogImage: '/img/createevents.jpg',
            ogDescription: 'ecomrade allows you to plan and promote your events with ease. Create exciting and engaging events that bring people together.',
            favicon: '/favicon.ico'
        },
    },
    
    {
        path: "/createmarket",
        name: "CreateMarket",
        component: CreateMarket,
        meta: {
            title: 'Advertise Products and Services :- ecomrade',
            description: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            keywords: 'ecomrade, events, plan, promote, community, engagement, gatherings, activities, celebrations, parties.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Advertise Products and Services - ecomrade',
            ogImage: '/img/postproducts.png',
            ogDescription: 'Find the latest and greatest products and services from fellow comrades on ecomrade. From fashion and beauty to tech and home goods, we\'ve got you covered.',
            favicon: '/favicon.ico'
        },
    },
    
    {
        path: "/createpoll",
        name: "CreatePoll",
        component: CreatePoll,
        meta: {
            title: 'Create poll :- ecomrade',
            description: 'Create thought-provoking polls and surveys on ecomrade to collect valuable feedback and insights. Gather opinions and make data-driven decisions for personal or business purposes.',
            keywords: 'polls, surveys, opinions, feedback, data-driven decisions, ecomrade',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Create poll - ecomrade',
            ogImage: '/img/createpoll.png',
            ogDescription: 'Create thought-provoking polls and surveys on ecomrade to collect valuable feedback and insights. Gather opinions and make data-driven decisions for personal or business purposes.',
            favicon: '/favicon.ico'
        },
    },
    
    {
        path: "/createrental",
        name: "CreateRental",
        component: CreateRental,
        meta: {
            title: 'Create rental :- ecomrade',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/editBlog:slug",
        name: "EditBlog",
        component: EditBlog,
        meta: {
            requiresGuest: true,
            title: 'Edit blog:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/editClub:slug",
        name: "EditClub",
        component: EditClub,
        meta: {
            requiresGuest: true,
            title: 'Edit club:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/editResource:slug",
        name: "EditResource",
        component: EditResource,
        meta: {
            requiresGuest: true,
            title: 'Edit resource:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editEvent:slug",
        name: "EditEvent",
        component: EditEvent,
        meta: {
            requiresGuest: true,
            title: 'Edit event:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editMarket:slug",
        name: "EditMarket",
        component: EditMarket,
        meta: {
            requiresGuest: true,
            title: 'Edit product:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editPoll:slug",
        name: "EditPoll",
        component: EditPoll,
        meta: {
            requiresGuest: true,
            title: 'Edit poll:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editRental:slug",
        name: "EditRental",
        component: EditRental,
        meta: {
            requiresGuest: true,
            title: 'Edit rental:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editProfile:slug",
        name: "EditProfile",
        component: EditProfile,
        meta: {
            requiresGuest: true,
            title: 'Edit profile:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/editPassword:slug",
        name: "EditPassword",
        component: EditPassword,
        meta: {
            requiresGuest: true,
            title: 'Edit password:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },
    {
        path: "/createBlogCategory",
        name: "CreateBlogCategory",
        component: CreateBlogCategory,
        meta: {
            requiresGuest: true,
            title: 'Create blog category:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createMarketCategory",
        name: "CreateMarketCategory",
        component: CreateMarketCategory,
        meta: {
            requiresGuest: true,
            title: 'Create market category:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createRentalCategory",
        name: "CreateRentalCategory",
        component: CreateRentalCategory,
        meta: {
            requiresGuest: true,
            title: 'Create rental category:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createLocation",
        name: "CreateLocation",
        component: CreateLocation,
        meta: {
            requiresGuest: true,
            title: 'Create location:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createYear",
        name: "CreateYear",
        component: CreateYear,
        meta: {
            requiresGuest: true,
            title: 'Create year:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createCourse",
        name: "CreateCourse",
        component: CreateCourse,
        meta: {
            requiresGuest: true,
            title: 'Create course:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/createmarketsubcategory",
        name: "CreateMarketSubCategory",
        component: CreateMarketSubCategory,
        meta: {
            requiresGuest: true,
            title: 'Create market sub-category:- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/polishBlogCategory:id",
        name: "PolishBlogCategory",
        component: PolishBlogCategory,
        meta: {
            requiresGuest: true,
            title: 'Edit blog category:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishMarketCategory:id",
        name: "PolishMarketCategory",
        component: PolishMarketCategory,
        meta: {
            requiresGuest: true,
            title: 'Edit market category:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishRentalCategory:id",
        name: "PolishRentalCategory",
        component: PolishRentalCategory,
        meta: {
            requiresGuest: true,
            title: 'Edit rental category:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishLocation:id",
        name: "PolishLocation",
        component: PolishLocation,
        meta: {
            requiresGuest: true,
            title: 'Edit location:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishYear:id",
        name: "PolishYear",
        component: PolishYear,
        meta: {
            requiresGuest: true,
            title: 'Edit year:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishCourse:id",
        name: "PolishCourse",
        component: PolishCourse,
        meta: {
            requiresGuest: true,
            title: 'Edit course:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/polishmarketsubcategory:id",
        name: "PolishMarketSubCategory",
        component: PolishMarketSubCategory,
        meta: {
            requiresGuest: true,
            title: 'Edit market sub-category:- ecomrade',
            favicon: '/favicon.ico'
        },
        props: true
    },

    {
        path: "/club",
        name: "Club",
        component: Club,
        meta: {
            title: 'Clubs and societies :- ecomrade',
            description: 'Join ecomrade clubs and societies to network and socialize with fellow students, and engage in activities and events based on your interests. Develop your leadership, collaboration, and creativity skills while building meaningful connections. Become a member and get involved in a community that values innovation and concept-sharing.',
            keywords: 'ecomrade clubs, societies, student organizations, campus groups, networking, socializing, activities, events, interest-based communities, leadership, collaboration, innovation, creativity, membership, involvement',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Clubs and societies - ecomrade',
            ogImage: '/web/club.jpeg',
            ogDescription: 'Join ecomrade clubs and societies to network and socialize with fellow students, and engage in activities and events based on your interests. Develop your leadership, collaboration, and creativity skills while building meaningful connections. Become a member and get involved in a community that values innovation and concept-sharing.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/resource",
        name: "Resource",
        component: Resource,
        meta: {
            title: 'Learning Resources :- ecomrade',
            description: 'ecomrade offers a variety of learning resources, including articles, videos, and podcasts, to help you enhance your knowledge and skills. Explore our platform and find valuable educational content on various topics.',
            keywords: 'learning resources, articles, videos, podcasts, education, knowledge, skills, ecomrade.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Learning Resources - ecomrade',
            ogImage: '/web/learningresources.jpg',
            ogDescription: 'ecomrade offers a variety of learning resources, including articles, videos, and podcasts, to help you enhance your knowledge and skills. Explore our platform and find valuable educational content on various topics.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/contact",
        name: "Contact",
        component: Contact,
        meta: {
            title: 'Contact us :- ecomrade',
            description: 'Need assistance or have inquiries about ecomrade? Our support team is here to help you with problem-solving and answer any questions. Contact us for support through communication.',
            keywords: 'ecomrade contact, customer service, support, feedback, inquiries, assistance, help, reach out, communication, problem-solving, resolution.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Contact Us - ecomrade',
            ogImage: '/contact.jpg',
            ogDescription: 'Need assistance or have inquiries about ecomrade? Our support team is here to help you with problem-solving and answer any questions. Contact us for support through communication.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/terms",
        name: "Terms",
        component: Terms,
        meta: {
            title: 'Terms & conditions :- ecomrade',
            description: 'This is the page that outlines the terms and conditions of using ecomrade, a social networking platform for connecting with like-minded individuals. This page explains the rules and guidelines that users must adhere to when using the platform, and the terms of service that govern the relationship between the user and ecomrade',
            keywords: 'ecomrade, terms and conditions, rules, guidelines, social networking, platform, terms of service, user agreement, community guidelines, user responsibilities.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Terms & conditions - ecomrade',
            ogImage: '/contact.jpg',
            ogDescription: 'This is the page that outlines the terms and conditions of using ecomrade, a social networking platform for connecting with like-minded individuals. This page explains the rules and guidelines that users must adhere to when using the platform, and the terms of service that govern the relationship between the user and ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/privacy",
        name: "Privacy",
        component: Privacy,
        meta: {
            title: 'Privacy Policy for ecomrade :- ecomrade',
            description: 'This privacy policy outlines how Ecomrade collects, uses, and protects personal information of its users.',
            keywords: 'ecomrade, privacy, policy, personal information, users, data protection.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Privacy Policy for ecomrade - ecomrade',
            ogImage: '/contact.jpg',
            ogDescription: 'This privacy policy outlines how Ecomrade collects, uses, and protects personal information of its users.',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/push",
        name: "Push",
        component: Push,
        meta: {
            title: 'Push :- ecomrade',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/faq",
        name: "Faq",
        component: Faq,
        meta: {
            title: 'F.A.Q :- ecomrade',
            description: 'Find answers to common questions on our ecomrade FAQ page. Get help with troubleshooting, policies, and account management. Contact us for more support!',
            keywords: ', ecomrade FAQ, Frequently asked questions, Help center, Support, Troubleshooting, Guides, Tutorials, User manual, Policies, Terms and conditions, Privacy, Security, Account management, Registration, Login, Password reset, Email verification, Contact us, Feedback, Suggestions, Community guidelines, Forum, Chat support, Technical issues',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'F.A.Q - ecomrade',
            ogImage: '/img/faq.png',
            ogDescription: 'Find answers to common questions on our ecomrade FAQ page. Get help with troubleshooting, policies, and account management. Contact us for more support!',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/market",
        name: "Market",
        component: Market,
        meta: {
            title: 'Market :- ecomrade',
            description: 'Discover deals on our campus e-marketplace! Buy, sell, or trade in-person with cash payments. Connect with fellow students and shop smarter on ecomrade!',
            keywords: 'E-marketplace, Online marketplace, Buying, Selling, Trade, Barter, Goods, Services, Products, Merchandise, Second-hand, Used, New, Discounts, Deals, Coupons, Offers, Negotiation, Transactions, Cash, Local pickup, Delivery, Trade-in, Donation',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Market - ecomrade',
            ogImage: '/assets/images/demos/denim.jpg',
            ogDescription: 'Discover deals on our campus e-marketplace! Buy, sell, or trade in-person with cash payments. Connect with fellow students and shop smarter on ecomrade!',
            favicon: '/favicon.ico'
        },
    },


    {
        path: "/poll",
        name: "Poll",
        component: Poll,
        meta: {
            title: 'Polls :- ecomrade',
            description: 'Gather opinions and feedback with ecomrade customizable polls. Engage your audience with multiple choice and open-ended questions. Try it now!',
            keywords: 'Polls, Surveys, Feedback, Voting, Questionnaires, Opinions, Data collection, Market research, Public opinion, User engagement, User feedback, User experience, User interface, Social media, Analytics, Results, Reports, Insights, Trends, Demographics, Target audience, Customized polls, Multiple choice, Rating scales, Open-ended questions, Anonymous voting, Poll expiration, Poll sharing, Poll moderation, Poll embedding',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Polls - ecomrade',
            ogImage: '/img/poll.jpeg',
            ogDescription: 'Gather opinions and feedback with ecomrade customizable polls. Engage your audience with multiple choice and open-ended questions. Try it now!',
            favicon: '/favicon.ico'
        },
    },

    {
        path: "/rental",
        name: "Rental",
        component: Rental,
        meta: {
            title: 'Rentals :- ecomrade',
            description: 'Find affordable and secure rentals around your campus with ecomrade. Apartments, rooms, shared housing, and convenient amenities. Find your next home now!',
            keywords: 'Affordable rentals, Safe rentals, Secure rentals, Campus rentals, Student housing, Off-campus housing, Apartments, Rooms, Shared housing, Lease, Tenancy, Landlord, Tenant, Property management, Amenities, Utilities, Furnished, Unfurnished, Laundry facilities, Parking, Pet-friendly, Neighborhoods, Public transportation, Move-in specials, Rental agreements, Rent payments, Maintenance, Community rentals',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Rentals - ecomrade',
            ogImage: '/img/rental.webp',
            ogDescription: 'Find affordable and secure rentals around your campus with ecomrade. Apartments, rooms, shared housing, and convenient amenities. Find your next home now!',
            favicon: '/favicon.ico'
        },
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            requiresGuest: true,
            title: 'Sign in :- ecomrade',
            description: 'Sign in to your ecomrade account to access your user profile and explore the platform. Ensure secure authentication and password protection for your account.',
            keywords: 'ecomrade login, sign in, account, user profile, access, authentication, security, password.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Sign in - ecomrade',
            ogImage: '/img/login.webp',
            ogDescription: 'Sign in to your ecomrade account to access your user profile and explore the platform. Ensure secure authentication and password protection for your account.',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {
            requiresGuest: true,
            title: 'Sign up :- ecomrade',
            description: ' Create your ecomrade account by filling out the registration form and enjoy access to a personalized user profile on the platform. Ensure secure authentication and password protection for your account.',
            keywords: 'ecomrade register, sign up, create account, user profile, registration form, authentication, security.',
            author: 'Dennis Chiira',
            robots: 'index, follow',
            ogTitle: 'Sign up - ecomrade',
            ogImage: '/img/register.png',
            ogDescription: ' Create your ecomrade account by filling out the registration form and enjoy access to a personalized user profile on the platform. Ensure secure authentication and password protection for your account.',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/dashboard",
        name: "AdmDashboard",
        component: AdmDashboard,
        meta: {
            requiresGuest: true,
            title: 'Dashboard:- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admuser",
        name: "AdmUser",
        component: AdmUser,
        meta: {
            requiresGuest: true,
            title: 'All users :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/searchuser",
        name: "SearchUser",
        component: SearchUser,
        meta: {
            requiresGuest: true,
            title: 'Search Comrade :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admblog",
        name: "AdmBlog",
        component: AdmBlog,
        meta: {
            requiresGuest: true,
            title: 'All blogs :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admBlogCat",
        name: "AdmBlogCat",
        component: AdmBlogCat,
        meta: {
            requiresGuest: true,
            title: 'All blog categories :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admclub",
        name: "AdmClub",
        component: AdmClub,
        meta: {
            requiresGuest: true,
            title: 'All clubs :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admevent",
        name: "AdmEvent",
        component: AdmEvent,
        meta: {
            requiresGuest: true,
            title: 'All events :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admeventreport",
        name: "AdmEventReport",
        component: AdmEventReport,
        meta: {
            requiresGuest: true,
            title: 'All event reports :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admrentalreport",
        name: "AdmRentalReport",
        component: AdmRentalReport,
        meta: {
            requiresGuest: true,
            title: 'All rental reports :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admrentalbooking",
        name: "AdmRentalBooking",
        component: AdmRentalBooking,
        meta: {
            requiresGuest: true,
            title: 'All rental bookings :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admeventbooking",
        name: "AdmEventBooking",
        component: AdmEventBooking,
        meta: {
            requiresGuest: true,
            title: 'All event bookings :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admfeed",
        name: "AdmFeed",
        component: AdmFeed,
        meta: {
            requiresGuest: true,
            title: 'All feeds :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admmarketreport",
        name: "AdmMarketReport",
        component: AdmMarketReport,
        meta: {
            requiresGuest: true,
            title: 'All market reports :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admlocation",
        name: "AdmLocation",
        component: AdmLocation,
        meta: {
            requiresGuest: true,
            title: 'Locations :- ecomrade',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/admyear",
        name: "AdmYear",
        component: AdmYear,
        meta: {
            requiresGuest: true,
            title: 'Years :- ecomrade',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/admcourse",
        name: "AdmCourse",
        component: AdmCourse,
        meta: {
            requiresGuest: true,
            title: 'Courses :- ecomrade',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/admmarket",
        name: "AdmMarket",
        component: AdmMarket,
        meta: {
            requiresGuest: true,
            title: 'All products :- ecomrade',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/admresource",
        name: "AdmResource",
        component: AdmResource,
        meta: {
            requiresGuest: true,
            title: 'All resources :- ecomrade',
            favicon: '/favicon.ico'
        }
    },

    {
        path: "/admpoll",
        name: "AdmPoll",
        component: AdmPoll,
        meta: {
            requiresGuest: true,
            title: 'All polls :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admmarketcat",
        name: "AdmMarketCat",
        component: AdmMarketCat,
        meta: {
            requiresGuest: true,
            title: 'All product categories :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admmarketsubcat",
        name: "AdmMarketSubCat",
        component: AdmMarketSubCat,
        meta: {
            requiresGuest: true,
            title: 'All product sub-categories :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admrental",
        name: "AdmRental",
        component: AdmRental,
        meta: {
            requiresGuest: true,
            title: 'All rentals :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    {
        path: "/admrentalcat",
        name: "AdmRentalCat",
        component: AdmRentalCat,
        meta: {
            requiresGuest: true,
            title: 'All rental categories :- ecomrade',
            favicon: '/favicon.ico'
        }
    },
    { path: '/:pathMatch(.*)*', name: 'not-found', component: NotFound },
    // if you omit the last `*`, the `/` character in params will be encoded when resolving or pushing
    { path: '/:pathMatch(.*)', name: 'bad-not-found', component: NotFound },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    // Display the page loader component
    const pageLoader = document.getElementById('page-loader');
    if (pageLoader) {
        pageLoader.style.display = 'block';
    }

    next();
});

router.afterEach((to, from) => {
    // Hide the page loader component
    const pageLoader = document.getElementById('page-loader');
    if (pageLoader) {
        pageLoader.style.display = 'none';
    }
});

router.beforeEach((to, from, next) => {
    const meta = to.meta;
    document.title = meta.title;
    const metaTags = document.getElementsByTagName('meta');
    for (let i = 0; i < metaTags.length; i++) {
        const tag = metaTags[i];
        const name = tag.getAttribute('name');
        const property = tag.getAttribute('property');

        if (name === 'description' || property === 'og:description') {
            tag.setAttribute('content', meta.description);
        } else if (name === 'keywords') {
            tag.setAttribute('content', meta.keywords);
        } else if (name === 'author') {
            tag.setAttribute('content', meta.author);
        } else if (name === 'robots') {
            tag.setAttribute('content', meta.robots);
        } else if (property === 'og:title') {
            tag.setAttribute('content', meta.ogTitle);
        } else if (property === 'og:image') {
            tag.setAttribute('content', meta.ogImage);
        } else if (property === 'og:description') {
            tag.setAttribute('content', meta.ogDescription);
        } else if (name === 'favicon') {
            const faviconLink = document.createElement('link');
            faviconLink.setAttribute('rel', 'icon');
            faviconLink.setAttribute('type', 'image/x-icon');
            faviconLink.setAttribute('href', meta.favicon);
            document.head.appendChild(faviconLink);
        }
    }
    next();
});

export default router;
