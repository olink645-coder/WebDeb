import streamlit as st
import pandas as pd
from temp_monitor import TemperatureMonitor
from utils import validate_reading

st.title("🌡️ HVAC Smart Controller Simulation")

# User input for window size
k_val = st.sidebar.number_input("Window Size (k)", min_value=1, value=3)

# Initialize monitor in session state
if 'monitor' not in st.session_state:
    st.session_state.monitor = TemperatureMonitor(k=k_val)
    st.session_state.history = []

# Input for new readings
new_input = st.text_input("Enter Temperature Reading (°C):")

if st.button("Add Reading"):
    try:
        val = validate_reading(new_input)
        st.session_state.monitor.add_reading(val)
        avg = st.session_state.monitor.moving_average()
        
        # Track history for the graph
        st.session_state.history.append({"Reading": val, "Average": avg})
        
        # UI Feedback [cite: 157-158]
        st.metric("Moving Average", f"{avg:.2f} °C")
        st.info(f"AC Status: {'ON' if avg > 25 else 'OFF'}")
        
        # Display Graph [cite: 156]
        df = pd.DataFrame(st.session_state.history)
        st.line_chart(df)
        
    except ValueError as e:
        st.error(e)