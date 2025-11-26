#[macro_export]
macro_rules! css {
    ({ $($tt:tt)* }) => {{
        let t = stringify!($($tt)*);
        t.to_string()  // agora retorna String (heap)
    }};
}
