// Wait for the DOM to fully load before executing any script
// Get current time and format it as HH:MM AM/PM
function getCurrentTime() {
  const now = new Date();
  return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

// Inject the time into the #ts element
document.addEventListener('DOMContentLoaded', function() {
  const tsElement = document.getElementById('ts');
  if (tsElement) {
    tsElement.textContent = getCurrentTime();
  }
});


function toggleChat() {
  document.getElementById("chatBox").classList.toggle("active");
}

document.addEventListener('DOMContentLoaded', function() {

  // DOM element references
  const chatMessages = document.getElementById('chatMessages');
  const questionInput = document.getElementById('questionInput');
  const sendButton = document.getElementById('sendButton');
  const suggestionsContainer = document.getElementById('suggestions');
  const suggestionsToggle = document.getElementById('suggestionsToggle');
  const themeToggle = document.getElementById('themeToggle');
  const voiceRecord = document.getElementById('voiceRecord');
  const voiceStatus = document.getElementById('voiceStatus');
  
  let suggestions = []; // Will be populated from API


  // 💡 Suggestions toggle for mobile
  if (suggestionsToggle && suggestionsContainer) {
    // Set initial state (collapsed on mobile)
    if (window.innerWidth <= 768) {
      suggestionsToggle.classList.add('collapsed');
    }
    
    suggestionsToggle.addEventListener('click', function() {
      const isExpanded = suggestionsContainer.classList.contains('expanded');
      
      if (isExpanded) {
        suggestionsContainer.classList.remove('expanded');
        suggestionsToggle.classList.add('collapsed');
      } else {
        suggestionsContainer.classList.add('expanded');
        suggestionsToggle.classList.remove('collapsed');
      }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth > 768) {
        // On desktop, always show suggestions and remove collapsed class
        suggestionsContainer.classList.remove('expanded');
        suggestionsToggle.classList.remove('collapsed');
      } else if (window.innerWidth <= 768 && !suggestionsContainer.classList.contains('expanded')) {
        // On mobile, ensure collapsed state if not expanded
        suggestionsToggle.classList.add('collapsed');
      }
    });
  }

  // 🌗 Theme toggle functionality
  let isDarkMode = true; // Default theme is dark
  themeToggle.addEventListener('click', function() {
    isDarkMode = !isDarkMode;
    document.body.setAttribute('data-theme', isDarkMode ? 'dark' : 'light');
    themeToggle.innerHTML = isDarkMode ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    themeToggle.setAttribute('title', isDarkMode ? 'Switch to light mode' : 'Switch to dark mode');
  });

  // 🎙️ Voice recognition setup
  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  let recognition = null;
  let isRecording = false;
  let istyping = false;

  const langMap = { "eng": "en-US", "arb": "ar-SA" };

  if (SpeechRecognition) {
    recognition = new SpeechRecognition();
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    recognition.onstart = function() {
      isRecording = true;
      voiceRecord.classList.add('voice-recording');
      voiceStatus.textContent = "Listening...";
    };

    recognition.onresult = function(event) {
      const transcript = event.results[0][0].transcript;
      questionInput.value = transcript;
      voiceStatus.textContent = "Speech recognized!";

      setTimeout(() => {
        voiceStatus.textContent = "";
        sendMessage();
      }, 1000);
    };

    recognition.onerror = function(event) {
      console.error('Speech recognition error', event.error);
      voiceStatus.textContent = `Error: ${event.error}`;
      setTimeout(() => { voiceStatus.textContent = ""; }, 3000);
      isRecording = false;
      voiceRecord.classList.remove('voice-recording');
    };

    recognition.onend = function() {
      isRecording = false;
      voiceRecord.classList.remove('voice-recording');
      if (voiceStatus.textContent === "Listening...") {
        voiceStatus.textContent = "";
      }
    };

    voiceRecord.addEventListener('click', function() {
      if (isRecording) {
        recognition.stop();
        voiceStatus.textContent = "Stopped listening";
        setTimeout(() => { voiceStatus.textContent = ""; sendMessage();}, 1000);
      } else {
        try {
          recognition.start();
          voiceStatus.textContent = "Starting voice recognition...";
        } catch (err) {
          console.error('Recognition start error:', err);
          voiceStatus.textContent = "Cannot start voice recognition";
          setTimeout(() => { voiceStatus.textContent = ""; }, 2000);
        }
      }
    });
  } else {
    voiceRecord.style.display = 'none';
    console.warn('Speech Recognition API not supported in this browser');
  }

  // 💡 Suggestion clicks are now handled in renderQuickActions function

  // 📨 Send button click triggers message
  sendButton.addEventListener('click', sendMessage);

  // ⌨️ Enter key triggers message
  questionInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      sendMessage();
    }
  });

  // 🔁 Main function to send user message and handle response
  async function sendMessage() {
    if (!istyping) {
      const question = questionInput.value.trim();
      if (!question) return;

      addMessage(question, 'user');
      questionInput.value = '';

      const typingIndicator = addTypingIndicator();

      try {
        const response = await fetch("ignitephp/api/aichat", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ question })
        });

        chatMessages.removeChild(typingIndicator);
        istyping = false;

        const responseText = await response.text();
        
        let data;

        try {
          data = JSON.parse(responseText);
        } catch (e) {
          console.error("JSON parse error:", e, "Response:", responseText);
          addMessage("⚠️ Sorry, something went wrong. Please try again later.", 'bot');
          return;
        }

        if (data.status === 'error') {
          console.warn("Server returned error:", data.message);
          // Use markdown if available, otherwise fallback to message
          if (data.markdown) {
            addMarkdownMessage(data.markdown, 'bot');
          } else {
            addMessage("❌ Sorry, I couldn't process that request. Please try again.", 'bot');
          }
        } else if (data.status === 'success') {
          // ✅ Use Markdown rendering if available
          if (data.markdown) {
            addMarkdownMessage(data.markdown, 'bot');
          } else {
            // Fallback to old rendering (for backward compatibility)
            let ans = '';
            if (data.summary) {
              let cleanSummary = data.summary.replace(/\\\//g, "/");
              ans = cleanSummary;
            }

            // Check if this is an aggregate query (count, sum, total) - show only message, no table
            if (data.is_aggregate === true && data.message) {
              addMessage(data.message, 'bot');
            }
            // If has records and NOT an aggregate query, show table
            else if (Array.isArray(data.records) && data.records.length > 0 && data.is_aggregate !== true) {
              if (typeof data.records[0] === 'object') {
                const keys = Object.keys(data.records[0]);
                
                // Detect numeric columns
                const numericColumns = new Set();
                keys.forEach(key => {
                  const lowerKey = key.toLowerCase();
                  // Check if column name suggests numeric data
                  if (lowerKey.includes('amount') || lowerKey.includes('price') || 
                      lowerKey.includes('total') || lowerKey.includes('paid') || 
                      lowerKey.includes('due') || lowerKey.includes('quantity') || 
                      lowerKey.includes('count') || lowerKey.includes('number') || 
                      lowerKey.includes('id') || lowerKey.includes('revenue') ||
                      lowerKey.includes('expense') || lowerKey.includes('balance') ||
                      lowerKey.includes('cost') || lowerKey.includes('fee')) {
                    numericColumns.add(key);
                  } else {
                    // Check if all values in this column are numeric
                    const allNumeric = data.records.every(row => {
                      const value = row[key];
                      return value === null || value === undefined || 
                             (typeof value === 'string' && /^[\d,.-]+$/.test(value)) ||
                             (typeof value === 'number');
                    });
                    if (allNumeric && data.records.length > 0) {
                      numericColumns.add(key);
                    }
                  }
                });
                
                let tableHtml = `<table class="message-table"><tr>`;
                keys.forEach(key => { 
                  const isNumeric = numericColumns.has(key);
                  tableHtml += `<th class="${isNumeric ? 'numeric' : ''}">${key}</th>`; 
                });
                tableHtml += `</tr>`;
                data.records.forEach(row => {
                  tableHtml += `<tr>`;
                  keys.forEach(key => {
                    let cellValue = row[key] !== null && row[key] !== undefined ? row[key] : "—";
                    const isNumeric = numericColumns.has(key);
                    tableHtml += `<td class="${isNumeric ? 'numeric' : ''}">${cellValue}</td>`;
                  });
                  tableHtml += `</tr>`;
                });
                tableHtml += `</table>`;
                ans += tableHtml;
                addMessage(ans, 'bot');
              } else {
                const listOutput = data.records.map(item => `• ${item}`).join('<br>');
                addMessage(listOutput, 'bot');
              }
            } else if (data.message && typeof data.message === 'string') {
              addMessage(data.message, 'bot');
            } else {
              addMessage("No records found for your request.", 'bot');
            }
          }
        } else {
          addMessage("⚠️ Sorry, I didn't understand the response. Please try again.", 'bot');
        }
      } catch (err) {
        if (typingIndicator.parentNode) {
          chatMessages.removeChild(typingIndicator);
        }
        console.error("Fetch error:", err);
        addMessage("🌐 Sorry, I'm having trouble connecting right now. Please try again later.", 'bot');
      }
    }
  }

  // 📝 Utility to add a Markdown message to chat window
  function addMarkdownMessage(markdown, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}-message`;

    const messageContent = document.createElement('div');
    messageContent.className = 'message-content markdown-content';

    // Configure marked.js options
    if (typeof marked !== 'undefined') {
      marked.setOptions({
        breaks: true,
        gfm: true, // GitHub Flavored Markdown (supports tables)
        headerIds: false,
        mangle: false
      });

      // Convert Markdown to HTML
      const html = marked.parse(markdown);
      messageContent.innerHTML = html;
    } else {
      // Fallback if marked.js not loaded
      messageContent.innerHTML = markdown.replace(/\n/g, '<br>');
    }

    const timestamp = document.createElement('div');
    timestamp.className = 'timestamp';
    timestamp.textContent = getCurrentTime();
    messageContent.appendChild(timestamp);

    messageDiv.appendChild(messageContent);
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    return messageDiv;
  }

  // 🧱 Utility to add a message to chat window (legacy, kept for compatibility)
  function addMessage(content, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}-message`;

    const messageContent = document.createElement('div');
    messageContent.className = 'message-content';

    if (type === 'user') {
      messageContent.innerHTML = `<p>${content}</p>`;
    } else {
      messageContent.innerHTML = content;
    }

    const timestamp = document.createElement('div');
    timestamp.className = 'timestamp';
    timestamp.textContent = getCurrentTime();
    messageContent.appendChild(timestamp);

    messageDiv.appendChild(messageContent);
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    return messageDiv;
  }

  // ✍️ Show typing indicator while waiting for bot response
  function addTypingIndicator() {
    istyping = true;
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message bot-message';
    messageDiv.id = 'typing-indicator';

    const messageContent = document.createElement('div');
    messageContent.className = 'typing-indicator';

    for (let i = 0; i < 3; i++) {
      const dot = document.createElement('div');
      dot.className = 'typing-dot';
      messageContent.appendChild(dot);
    }

    messageDiv.appendChild(messageContent);
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    return messageDiv;
  }

  // Expose sendMessage function globally for UI configuration
  window.sendMessage = sendMessage;

});
 