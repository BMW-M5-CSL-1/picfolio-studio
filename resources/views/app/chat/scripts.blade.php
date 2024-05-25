<script>
    // Load Chat
    function getChatData($id) {
        $.ajax({
            type: "post",
            url: "{{ route('chat.ajax-get-chat', ['id' => ':id']) }}".replace(':id', $id),
            data: {
                id: $id
            },
            dataType: "json",
            success: function(response) {
                if (response.success == true) {
                    var user = response.user,
                        messages = response.messages;
                    if (messages.length > 0) {
                        $('#no-message-heading').addClass('d-none');
                        $('#choose_contact').addClass('d-none');
                        $('#my-chat-list').empty();
                        messages.forEach(function(item) {
                            var formattedDate = moment(item.created_at).format(
                                "MMM D, YYYY hh:mmA");
                            if (item.created_by == '{{ Auth::user()->id }}') {
                                var my_message = $('<li>').addClass(
                                    "chat-message chat-message-right").html(
                                    '<div class="d-flex overflow-hidden"><div class="chat-message-wrapper flex-grow-1"><div class="chat-message-text"><p class="mb-0">' +
                                    item.message +
                                    '</p></div><div class="text-end text-muted mt-1"><i class="ti ti-check ti-xs me-1 text-success"></i><small>' +
                                    formattedDate +
                                    '</small></div></div><div class="user-avatar flex-shrink-0 ms-3"><div class="avatar avatar-sm"><img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar"class="rounded-circle"></div></div></div>'
                                );
                                $('#my-chat-list').append(my_message);
                            }
                            if (item.created_by != '{{ Auth::user()->id }}') {
                                var other_message = $('<li>').html(
                                    '<div class="d-flex overflow-hidden"><div class="user-avatar flex-shrink-0 me-3"><div class="avatar avatar-sm"><img src="' +
                                    user.profile_photo_url +
                                    '" alt="Avatar"class="rounded-circle"></div></div><div class="chat-message-wrapper flex-grow-1"><div class="chat-message-text"><p class="mb-0">' +
                                    item.message +
                                    '</p></div><div class="text-muted mt-1"><small>' +
                                    formattedDate + '</small></div></div></div>').addClass(
                                    'chat-message');

                                $('#my-chat-list').append(other_message);
                            }
                        });
                    } else {
                        $('#my-chat-list').empty();
                        $('#choose_contact').addClass('d-none');
                        $('#no-message-heading').removeClass('d-none');
                    }
                    $('.chat-user-avatar').attr("src", user.profile_photo_url);
                    $('.chat-user-name').text(user.name);
                    $('.chat-user-email').text(user.email);
                    $('.chat-user-contact').text(user.contact ?? '-');

                    $('#send_to').val(user.id);
                    $('#chat-body').removeClass('d-none');
                    // $('#chat-body').empty();
                    // $('#chat-body').append(response.chat_body);
                } else {
                    $('.chat-user-avatar').attr("src", '');
                    $('.chat-user-name').empty();
                    $('.chat-user-email').empty();
                    $('.chat-user-contact').empty();
                    $('#send_to').val('').trigger('change');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function sendMessage() {
        var send_to = $('#send_to').val();
        var message = $('#message').val();
        $.ajax({
            type: "post",
            url: "{{ route('chat.send-message') }}",
            data: {
                message: message,
                send_to: send_to,
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    hideBlockUI();
                    toastr.success(response
                        .message,
                        'Message Sent!', {
                            showMethod: "slideDown",
                            hideMethod: "slideUp",
                            timeOut: 2e3,
                            closeButton: !0,
                            tapToDismiss: !1,
                        });
                } else {
                    hideBlockUI();
                    Swal.fire({
                        icon: 'question',
                        title: 'Warning',
                        text: 'Something Went Wrong !',
                    })
                }
            },
            error: function(error) {
                hideBlockUI();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An Error Occured !',
                })
            }
        });
    }

    /**
     * App Chat
     */

    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        (function() {
            const chatContactsBody = document.querySelector('.app-chat-contacts .sidebar-body'),
                chatContactListItems = [].slice.call(
                    document.querySelectorAll('.chat-contact-list-item:not(.chat-contact-list-item-title)')
                ),
                chatHistoryBody = document.querySelector('.chat-history-body'),
                chatSidebarLeftBody = document.querySelector('.app-chat-sidebar-left .sidebar-body'),
                chatSidebarRightBody = document.querySelector('.app-chat-sidebar-right .sidebar-body'),
                chatUserStatus = [].slice.call(document.querySelectorAll(
                    ".form-check-input[name='chat-user-status']")),
                chatSidebarLeftUserAbout = $('.chat-sidebar-left-user-about'),
                formSendMessage = document.querySelector('.form-send-message'),
                messageInput = document.querySelector('.message-input'),
                searchInput = document.querySelector('.chat-search-input'),
                speechToText = $('.speech-to-text'), // ! jQuery dependency for speech to text
                userStatusObj = {
                    active: 'avatar-online',
                    offline: 'avatar-offline',
                    away: 'avatar-away',
                    busy: 'avatar-busy'
                };

            // Initialize PerfectScrollbar
            // ------------------------------

            // Chat contacts scrollbar
            if (chatContactsBody) {
                new PerfectScrollbar(chatContactsBody, {
                    wheelPropagation: false,
                    suppressScrollX: true
                });
            }

            // Chat history scrollbar
            if (chatHistoryBody) {
                new PerfectScrollbar(chatHistoryBody, {
                    wheelPropagation: false,
                    suppressScrollX: true
                });
            }

            // Sidebar left scrollbar
            if (chatSidebarLeftBody) {
                new PerfectScrollbar(chatSidebarLeftBody, {
                    wheelPropagation: false,
                    suppressScrollX: true
                });
            }

            // Sidebar right scrollbar
            if (chatSidebarRightBody) {
                new PerfectScrollbar(chatSidebarRightBody, {
                    wheelPropagation: false,
                    suppressScrollX: true
                });
            }

            // Scroll to bottom function
            function scrollToBottom() {
                chatHistoryBody.scrollTo(0, chatHistoryBody.scrollHeight);
            }
            scrollToBottom();

            // User About Maxlength Init
            if (chatSidebarLeftUserAbout.length) {
                chatSidebarLeftUserAbout.maxlength({
                    alwaysShow: true,
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: '/',
                    validate: true,
                    threshold: 120
                });
            }

            // Update user status
            chatUserStatus.forEach(el => {
                el.addEventListener('click', e => {
                    let chatLeftSidebarUserAvatar = document.querySelector(
                            '.chat-sidebar-left-user .avatar'),
                        value = e.currentTarget.value;
                    //Update status in left sidebar user avatar
                    chatLeftSidebarUserAvatar.removeAttribute('class');
                    Helpers._addClass('avatar avatar-xl ' + userStatusObj[value] + '',
                        chatLeftSidebarUserAvatar);
                    //Update status in contacts sidebar user avatar
                    let chatContactsUserAvatar = document.querySelector(
                        '.app-chat-contacts .avatar');
                    chatContactsUserAvatar.removeAttribute('class');
                    Helpers._addClass('flex-shrink-0 avatar ' + userStatusObj[value] +
                        ' me-3', chatContactsUserAvatar);
                });
            });

            // Select chat or contact
            chatContactListItems.forEach(chatContactListItem => {
                // Bind click event to each chat contact list item
                chatContactListItem.addEventListener('click', e => {
                    // Remove active class from chat contact list item
                    chatContactListItems.forEach(chatContactListItem => {
                        chatContactListItem.classList.remove('active');
                    });
                    // Add active class to current chat contact list item
                    e.currentTarget.classList.add('active');
                });
            });

            // Filter Chats
            if (searchInput) {
                searchInput.addEventListener('keyup', e => {
                    let searchValue = e.currentTarget.value.toLowerCase(),
                        searchChatListItemsCount = 0,
                        searchContactListItemsCount = 0,
                        chatListItem0 = document.querySelector('.chat-list-item-0'),
                        contactListItem0 = document.querySelector('.contact-list-item-0'),
                        searchChatListItems = [].slice.call(
                            document.querySelectorAll(
                                '#chat-list li:not(.chat-contact-list-item-title)')
                        ),
                        searchContactListItems = [].slice.call(
                            document.querySelectorAll(
                                '#contact-list li:not(.chat-contact-list-item-title)')
                        );

                    // Search in chats
                    searchChatContacts(searchChatListItems, searchChatListItemsCount, searchValue,
                        chatListItem0);
                    // Search in contacts
                    searchChatContacts(searchContactListItems, searchContactListItemsCount,
                        searchValue, contactListItem0);
                });
            }

            // Search chat and contacts function
            function searchChatContacts(searchListItems, searchListItemsCount, searchValue, listItem0) {
                searchListItems.forEach(searchListItem => {
                    let searchListItemText = searchListItem.textContent.toLowerCase();
                    if (searchValue) {
                        if (-1 < searchListItemText.indexOf(searchValue)) {
                            searchListItem.classList.add('d-flex');
                            searchListItem.classList.remove('d-none');
                            searchListItemsCount++;
                        } else {
                            searchListItem.classList.add('d-none');
                        }
                    } else {
                        searchListItem.classList.add('d-flex');
                        searchListItem.classList.remove('d-none');
                        searchListItemsCount++;
                    }
                });
                // Display no search fount if searchListItemsCount == 0
                if (searchListItemsCount == 0) {
                    listItem0.classList.remove('d-none');
                } else {
                    listItem0.classList.add('d-none');
                }
            }

            // Send Message
            formSendMessage.addEventListener('submit', e => {
                e.preventDefault();
                if (messageInput.value) {
                    // Create a div and add a class
                    let renderMsg = document.createElement('div');
                    renderMsg.className = 'chat-message-text mt-2';
                    renderMsg.innerHTML = '<p class="mb-0">' + messageInput.value + '</p>';
                    document.querySelector('li:last-child .chat-message-wrapper').appendChild(
                        renderMsg);
                    messageInput.value = '';
                    scrollToBottom();
                }
            });

            // on click of chatHistoryHeaderMenu, Remove data-overlay attribute from chatSidebarLeftClose to resolve overlay overlapping issue for two sidebar
            let chatHistoryHeaderMenu = document.querySelector(
                    ".chat-history-header [data-target='#app-chat-contacts']"),
                chatSidebarLeftClose = document.querySelector('.app-chat-sidebar-left .close-sidebar');
            chatHistoryHeaderMenu.addEventListener('click', e => {
                chatSidebarLeftClose.removeAttribute('data-overlay');
            });
            // }

            // Speech To Text
            if (speechToText.length) {
                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                if (SpeechRecognition !== undefined && SpeechRecognition !== null) {
                    var recognition = new SpeechRecognition(),
                        listening = false;
                    speechToText.on('click', function() {
                        const $this = $(this);
                        recognition.onspeechstart = function() {
                            listening = true;
                        };
                        if (listening === false) {
                            recognition.start();
                        }
                        recognition.onerror = function(event) {
                            listening = false;
                        };
                        recognition.onresult = function(event) {
                            $this.closest('.form-send-message').find('.message-input').val(event
                                .results[0][0].transcript);
                        };
                        recognition.onspeechend = function(event) {
                            listening = false;
                            recognition.stop();
                        };
                    });
                }
            }
        })();
    });
</script>
