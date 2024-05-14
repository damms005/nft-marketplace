# A demo Laravel NFT marketplace project

> **Note** <br />
> The Laravel 8 version is [👉🏼 here](https://github.com/damms005/nft-marketplace)

I needed an excuse to have a [Laravel Vite](https://laravel.com/docs/10.x/vite#main-content) project that has event broadcasting via real-time updates through [Laravel Echo](https://laravel.com/docs/10.x/broadcasting#client-side-installation) with simple basic (custom) turn-based authentication. It is powered by [Laravel Websocket](https://beyondco.de/docs/laravel-websockets) and [Livewire](https://laravel-livewire.com/docs). I also wanted to have a sample app that implements my [Laravel Multipay payments package](https://github.com/damms005/laravel-multipay).

So why not? 😜


## Installation

- Clone this repo

- Install dependencies
```
composer install
npm i
```

- Build assets
```
npm run dev
```

- Setup your database
```
sail artisan migrate:fresh --seed
```
> Heads up: in your `.env` file, ensure to provide `UNSPLASH_CLIENT_ID`. You can easily get one [here](https://unsplash.com/oauth/applications)


- Rumble! (for me, this meant running `sail up -d`. YMMV)

> **Note** <br />
> Ensure to have `.env`. `.env.example` is provided as a guide

> **Note** <br />
> If you want to test the included [payment package](https://github.com/damms005/laravel-multipay) with [Paystack](https://paystack.com), ensure you [setup it up as required](https://github.com/damms005/laravel-multipay#needed-third-party-integrations)

> **Warning** <br />
> If you find anything missing in this guide, please don't @ me 😂
