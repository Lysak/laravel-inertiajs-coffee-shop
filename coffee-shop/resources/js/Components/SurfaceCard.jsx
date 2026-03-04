export default function SurfaceCard({ as: Component = 'div', children, className = '', ...props }) {
    return (
        <Component {...props} className={`rounded-lg bg-white shadow-sm ${className}`}>
            {children}
        </Component>
    )
}
