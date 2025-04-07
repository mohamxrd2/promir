import { createRoot } from 'react-dom/client';

import React from 'react';

function Navbar() {
  return <>
    <div className="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-2 pb-2 px-4 group-data-[navbar=bordered]:pt-4 group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-4 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-2">
    <div className=" container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div className="flex justify-between items-center w-full group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl navbar-header group-data-[layout=horizontal]:ltr:xl:pr-3 group-data-[layout=horizontal]:rtl:xl:pl-3">
                <button type="button" className="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-75 ease-linear bg-topbar rounded-md btn hover:bg-slate-100 group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-dark group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-brand group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:dark:border-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[layout=horizontal]:flex group-data-[layout=horizontal]:md:hidden hamburger-icon" id="topnav-hamburger-icon">
                <i data-lucide="chevrons-left" className="w-5 h-5 group-data-[sidebar-size=sm]:hidden"></i>
                <i data-lucide="chevrons-right" className="hidden w-5 h-5 group-data-[sidebar-size=sm]:block"></i>
            </button>

            <div className="relative hidden ltr:ml-3 rtl:mr-3 lg:block group-data-[layout=horizontal]:hidden group-data-[layout=horizontal]:lg:block">
                <input type="text" className="py-2 pr-4 text-sm text-topbar-item bg-topbar border border-topbar-border rounded pl-8 placeholder:text-slate-400 form-control focus-visible:outline-0 min-w-[300px] focus:border-blue-400 group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-border-dark group-data-[topbar=dark]:placeholder:text-slate-500 group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-border-brand group-data-[topbar=brand]:placeholder:text-blue-300 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:border-zink-500 group-data-[topbar=dark]:dark:text-zink-100" placeholder="Cherchez ici ..." autoComplete="on" />
                <i data-lucide="search" className="inline-block size-4 absolute left-2.5 top-2.5 text-topbar-item fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:dark:fill-zink-600"></i>
            </div>

            <div className="flex gap-3 ms-auto">
               
                
                <div className="relative flex items-center h-header">
                    <button type="button" className="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:text-topbar-item-dark" id="light-dark-mode">
                        <i data-lucide="sun" className="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                    </button>
                </div>

                <div className="relative flex items-center h-header">
                    <button type="button" data-drawer-target="cartSidePenal" className="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:text-topbar-item-dark">
                        <i data-lucide="shopping-cart" className="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                        <span className="absolute flex items-center justify-center w-[16px] h-[16px] text-xs text-white bg-red-400 border-white rounded-full -top-1 -right-1">3</span>
                    </button>
                </div>

                <div className="relative flex items-center dropdown h-header">
                    <button type="button" className="inline-flex justify-center relative items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar rounded-md dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:text-topbar-item-dark" id="notificationDropdown" data-bs-toggle="dropdown">
                        <i data-lucide="bell-ring" className="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                        <span className="absolute top-0 right-0 flex w-1.5 h-1.5">
                            <span className="absolute inline-flex w-full h-full rounded-full opacity-75 animate-ping bg-sky-400"></span>
                            <span className="relative inline-flex w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                        </span>
                    </button>
                    
                    <div className="absolute z-50 hidden ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[20rem] lg:min-w-[26rem] dark:bg-zink-600" aria-labelledby="notificationDropdown">
                        <div className="p-4">
                            <h6 className="mb-4 text-16">Notifications <span className="inline-flex items-center justify-center w-5 h-5 ml-1 text-[11px] font-medium border rounded-full text-white bg-orange-500 border-orange-500">15</span></h6>
                            <ul className="flex flex-wrap w-full p-1 mb-2 text-sm font-medium text-center rounded-md filter-btns text-slate-500 bg-slate-100 nav-tabs dark:bg-zink-500 dark:text-zink-200" data-filter-target="notification-list">
                                <li className="grow">
                                    <a href="javascript:void(0);" data-filter="all" className="inline-block nav-link px-1.5 w-full py-1 text-xs transition-all duration-300 ease-linear rounded-md text-slate-500 border border-transparent [&.active]:bg-white [&.active]:text-custom-500 hover:text-custom-500 active:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:[&.active]:bg-zink-600 -mb-[1px] active">Voir plus</a>
                                </li>
                                <li className="grow">
                                    <a href="javascript:void(0);" data-filter="mention" className="inline-block nav-link px-1.5 w-full py-1 text-xs transition-all duration-300 ease-linear rounded-md text-slate-500 border border-transparent [&.active]:bg-white [&.active]:text-custom-500 hover:text-custom-500 active:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:[&.active]:bg-zink-600 -mb-[1px]">Mentions</a>
                                </li>
                                <li className="grow">
                                    <a href="javascript:void(0);" data-filter="follower" className="inline-block nav-link px-1.5 w-full py-1 text-xs transition-all duration-300 ease-linear rounded-md text-slate-500 border border-transparent [&.active]:bg-white [&.active]:text-custom-500 hover:text-custom-500 active:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:[&.active]:bg-zink-600 -mb-[1px]">Suiveurs</a>
                                </li>
                             
                            </ul>

                        </div>
                        <div data-simplebar="" className="max-h-[350px]">
                            <div className="flex flex-col gap-1" id="notification-list">
                                <a href="#!" className="flex gap-3 p-4 product-item hover:bg-slate-50 dark:hover:bg-zink-500 follower">
                                    <div className="w-10 h-10 rounded-md shrink-0 bg-slate-100">
                                        <img src="assets/images/avatar-3.png" alt="" className="rounded-md" />
                                    </div>
                                    <div className="grow">
                                        <h6 className="mb-1 font-medium"><b>@willie_passem</b> followed you</h6>
                                        <p className="mb-0 text-sm text-slate-500 dark:text-zink-300"><i data-lucide="clock" className="inline-block w-3.5 h-3.5 mr-1"></i> <span className="align-middle">Wednesday 03:42 PM</span></p>
                                    </div>
                                    <div className="flex items-center self-start gap-2 text-xs text-slate-500 shrink-0 dark:text-zink-300">
                                        <div className="w-1.5 h-1.5 bg-custom-500 rounded-full"></div> 4 sec
                                    </div>
                                </a>
                                <a href="#!" className="flex gap-3 p-4 product-item hover:bg-slate-50 dark:hover:bg-zink-500 mention">
                                    <div className="w-10 h-10 bg-yellow-100 rounded-md shrink-0">
                                        <img src="assets/images/avatar-5.png" alt="" className="rounded-md" />
                                    </div>
                                    <div className="grow">
                                        <h6 className="mb-1 font-medium"><b>@caroline_jessica</b> commented on your post</h6>
                                        <p className="mb-3 text-sm text-slate-500 dark:text-zink-300"><i data-lucide="clock" className="inline-block w-3.5 h-3.5 mr-1"></i> <span className="align-middle">Wednesday 03:42 PM</span></p>
                                        <div className="p-2 rounded bg-slate-100 text-slate-500 dark:bg-zink-500 dark:text-zink-300">Amazing! Fast, to the point, professional and really amazing to work with them!!!</div>
                                    </div>
                                    <div className="flex items-center self-start gap-2 text-xs text-slate-500 shrink-0 dark:text-zink-300">
                                        <div className="w-1.5 h-1.5 bg-custom-500 rounded-full"></div> 15 min
                                    </div>
                                </a>
                                <a href="#!" className="flex gap-3 p-4 product-item hover:bg-slate-50 dark:hover:bg-zink-500 invite">
                                    <div className="flex items-center justify-center w-10 h-10 bg-red-100 rounded-md shrink-0">
                                        <i data-lucide="shopping-bag" className="w-5 h-5 text-red-500 fill-red-200"></i>
                                    </div>
                                    <div className="grow">
                                        <h6 className="mb-1 font-medium">Successfully purchased a business plan for <span className="text-red-500">$199.99</span></h6>
                                        <p className="mb-0 text-sm text-slate-500 dark:text-zink-300"><i data-lucide="clock" className="inline-block w-3.5 h-3.5 mr-1"></i> <span className="align-middle">Monday 11:26 AM</span></p>
                                    </div>
                                    <div className="flex items-center self-start gap-2 text-xs text-slate-500 shrink-0 dark:text-zink-300">
                                        <div className="w-1.5 h-1.5 bg-custom-500 rounded-full"></div> Yesterday
                                    </div>
                                </a>
                                <a href="#!" className="flex gap-3 p-4 product-item hover:bg-slate-50 dark:hover:bg-zink-500 mention">
                                    <div className="relative shrink-0">
                                        <div className="w-10 h-10 bg-pink-100 rounded-md">
                                            <img src="assets/images/avatar-7.png" alt="" className="rounded-md" />
                                        </div>
                                        <div className="absolute text-orange-500 -bottom-0.5 -right-0.5 text-16">
                                            <i className="ri-heart-fill"></i>
                                        </div>
                                    </div>
                                    <div className="grow">
                                        <h6 className="mb-1 font-medium"><b>@scott</b> liked your post</h6>
                                        <p className="mb-0 text-sm text-slate-500 dark:text-zink-300"><i data-lucide="clock" className="inline-block w-3.5 h-3.5 mr-1"></i> <span className="align-middle">Thursday 06:59 AM</span></p>
                                    </div>
                                    <div className="flex items-center self-start gap-2 text-xs text-slate-500 shrink-0 dark:text-zink-300">
                                        <div className="w-1.5 h-1.5 bg-custom-500 rounded-full"></div> 1 Week
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div className="flex items-center gap-2 p-4 border-t border-slate-200 dark:border-zink-500">
                            <div className="grow">
                                <a href="#!">Manage Notification</a>
                            </div>
                            <div className="shrink-0">
                                <button type="button" className="px-2 py-1.5 text-xs text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100">Voir toutes les Notification <i data-lucide="move-right" className="inline-block w-3.5 h-3.5 ml-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="relative items-center hidden h-header md:flex">
                    <button data-drawer-target="customizerButton" type="button" className="inline-flex justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar group-data-[topbar=dark]:text-topbar-item-dark rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200">
                        <i data-lucide="settings" className="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                    </button>
                </div>

                <div className="relative flex items-center dropdown h-header">
                    <button type="button" className="inline-block p-0 transition-all duration-200 ease-linear bg-topbar rounded-full text-topbar-item dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200" id="dropdownMenuButton" data-bs-toggle="dropdown">
                        <div className="bg-pink-100 rounded-full">
                            <img src="{{ asset('storage/profile_images/' . Auth::user()->photo) }}" alt="" className="w-[37.5px] h-[37.5px] rounded-full" />
                        </div>
                    </button>
                    <div className="absolute z-50 hidden p-4 ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[14rem] dark:bg-zink-600" aria-labelledby="dropdownMenuButton">
                        <h6 className="mb-2 text-sm font-normal text-slate-500 dark:text-zink-300">Bienvenu sur promir</h6>
                        <a href="{{route('modify_user_profile')}}" className="flex gap-3 mb-3">
                            <div className="relative inline-block shrink-0">
                                <div className="rounded-full bg-slate-100 dark:bg-zink-500">
                                    <img src="{{ asset('storage/profile_images/' . Auth::user()->photo) }}" alt="" className="w-12 h-12 rounded-full" />
                                </div>
                                <span className="-top-1 ltr:-right-1 rtl:-left-1 absolute w-2.5 h-2.5 bg-green-400 border-2 border-white rounded-full dark:border-zink-600"></span>
                            </div>
                            <div>
                               <h6 className="mb-1 text-15">Barry Aziz</h6>
                                {/* <h6 className="mb-1 text-15">{{session('name')}}</h6>

                                <p className="text-slate-500 dark:text-zink-300">{{session('fonction')}}</p> */}
                            </div>
                        </a>
                        <ul>
                            <li>
                                <a className="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="{{route('modify_user_profile')}}">
                                    <i data-lucide="user-2" className="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a className="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="apps-mailbox.html">
                                    <i data-lucide="mail" className="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Notifications 
                                    <span className="inline-flex items-center justify-center w-5 h-5 ltr:ml-2 rtl:mr-2 text-[11px] font-medium border rounded-full text-white bg-red-500 border-red-500">12</span>
                                </a>
                            </li>
                            <li>
                                <a className="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="apps-chat.html">
                                    <i data-lucide="messages-square" className="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Messages
                                </a>
                            </li>
                            <li className="pt-2 mt-2 border-t border-slate-200 dark:border-zink-500">
                                <a className="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="{{ route('logout') }}">
                                    <i data-lucide="log-out" className="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </>;
}

const domNode = document.getElementById('nav-bar-react');
const root = createRoot(domNode);
root.render(<Navbar />);


